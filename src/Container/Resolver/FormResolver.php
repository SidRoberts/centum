<?php

namespace Centum\Container\Resolver;

use Centum\Container\Exception\FormFieldNotFoundException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FormInterface;
use ReflectionNamedType;
use ReflectionParameter;

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
    public function resolve(ReflectionParameter $parameter): mixed
    {
        $declaringClass = $parameter->getDeclaringClass();

        if ($declaringClass === null || !is_subclass_of($declaringClass->getName(), FormInterface::class)) {
            throw new UnresolvableParameterException($parameter);
        }

        $name = $parameter->getName();
        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            throw new UnresolvableParameterException($parameter);
        }

        if (!$type->isBuiltIn()) {
            throw new UnresolvableParameterException($parameter);
        }

        if ($type->getName() === "bool") {
            return $this->data->has($name);
        }

        if (!$this->data->has($name) && !$parameter->isOptional()) {
            throw new FormFieldNotFoundException($name);
        }

        /** @var mixed */
        $value = $this->data->get($name);

        if ($value === null) {
            if (!$parameter->allowsNull()) {
                throw new UnresolvableParameterException($parameter);
            }
        } else {
            $valueType = gettype($value);

            $valueType = match ($valueType) {
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
