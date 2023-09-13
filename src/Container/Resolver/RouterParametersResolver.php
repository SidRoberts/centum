<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\FormInterface;
use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\ParametersInterface;

class RouterParametersResolver implements ResolverInterface
{
    public function __construct(
        protected readonly ParametersInterface $parameters
    ) {
    }



    /**
     * @throws UnresolvableParameterException
     */
    public function resolve(ParameterInterface $parameter): mixed
    {
        if (!$parameter->hasDeclaringClass() || !is_subclass_of($parameter->getDeclaringClass(), ControllerInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        if ($parameter->hasType() && is_subclass_of($parameter->getType(), FormInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$parameter->hasName()) {
            throw new UnresolvableParameterException($parameter);
        }

        $name = $parameter->getName();

        if (!$this->parameters->has($name)) {
            throw new UnresolvableParameterException($parameter);
        }

        /** @var mixed */
        $value = $this->parameters->get($name);

        if ($value === null) {
            if ($parameter->hasDefaultValue()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new UnresolvableParameterException($parameter);
        } elseif (is_object($value)) {
            /** @var class-string */
            $typeName = $parameter->getType();

            if (!is_a($value, $typeName) && !is_subclass_of($value, $typeName)) {
                throw new UnresolvableParameterException($parameter);
            }
        } else {
            $valueType = gettype($value);

            $valueType = match ($valueType) {
                "boolean" => "bool",
                "double"  => "float",
                "integer" => "int",
                default   => $valueType,
            };

            if ($parameter->getType() !== $valueType) {
                throw new UnresolvableParameterException($parameter);
            }
        }

        return $value;
    }
}
