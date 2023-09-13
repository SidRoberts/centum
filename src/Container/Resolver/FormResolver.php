<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\FormFieldNotFoundException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FormInterface;

class FormResolver implements ResolverInterface
{
    public function __construct(
        protected readonly DataInterface $data
    ) {
    }



    /**
     * @throws UnresolvableParameterException
     * @throws FormFieldNotFoundException
     */
    public function resolve(ParameterInterface $parameter): mixed
    {
        if (!$parameter->hasDeclaringClass() || !is_subclass_of($parameter->getDeclaringClass(), FormInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$parameter->hasName()) {
            throw new UnresolvableParameterException($parameter);
        }

        if ($parameter->isObject()) {
            throw new UnresolvableParameterException($parameter);
        }

        $name = $parameter->getName();
        $type = $parameter->getType();

        if ($type === "bool") {
            return $this->data->has($name);
        }

        if (!$this->data->has($name)) {
            if ($parameter->hasDefaultValue()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new FormFieldNotFoundException($name);
        }

        /** @var mixed */
        $value = $this->data->get($name);

        if ($value === null) {
            if ($parameter->hasDefaultValue()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new UnresolvableParameterException($parameter);
        }

        $valueType = gettype($value);

        $valueType = match ($valueType) {
            "double"  => "float",
            "integer" => "int",
            default   => $valueType,
        };

        if ($valueType !== $type) {
            throw new UnresolvableParameterException($parameter);
        }

        return $value;
    }
}
