<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\FormInterface;
use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\ParametersInterface;
use ReflectionNamedType;
use ReflectionParameter;

class RouterParametersResolver implements ResolverInterface
{
    public function __construct(
        protected readonly ParametersInterface $parameters
    ) {
    }



    public function resolve(ReflectionParameter $parameter): mixed
    {
        $declaringClass = $parameter->getDeclaringClass();

        if ($declaringClass === null || !is_subclass_of($declaringClass->getName(), ControllerInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (is_subclass_of($type->getName(), FormInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        $name = $parameter->getName();

        if (!$this->parameters->has($name)) {
            throw new UnresolvableParameterException($parameter);
        }

        /** @var mixed */
        $value = $this->parameters->get($name);

        if ($value === null) {
            if (!$parameter->allowsNull()) {
                throw new UnresolvableParameterException($parameter);
            }
        } elseif (is_object($value)) {
            /** @var class-string */
            $typeName = $type->getName();

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

            if ($valueType !== $type->getName()) {
                throw new UnresolvableParameterException($parameter);
            }
        }

        return $value;
    }
}
