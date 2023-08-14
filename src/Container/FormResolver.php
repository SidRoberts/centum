<?php

namespace Centum\Container;

use Centum\Container\Exception\FileGroupNotFoundException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ResolverInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\FormInterface;
use Centum\Interfaces\Http\RequestInterface;
use ReflectionNamedType;
use ReflectionParameter;

class FormResolver implements ResolverInterface
{
    protected readonly DataInterface $data;
    protected readonly FilesInterface $files;



    public function __construct(
        protected readonly RequestInterface $request
    ) {
        $this->data  = $request->getData();
        $this->files = $request->getFiles();
    }



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
            $class = $type->getName();

            if ($class !== FileGroupInterface::class) {
                throw new UnresolvableParameterException($parameter);
            }

            if (!$this->files->has($name)) {
                throw new FileGroupNotFoundException($name);
            }

            return $this->files->get($name);
        }

        if ($type->getName() === "bool") {
            return $this->data->has($name);
        }

        if (!$this->data->has($name)) {
            throw new UnresolvableParameterException($parameter);
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
