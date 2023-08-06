<?php

namespace Centum\Http;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FilesInterface;
use Centum\Interfaces\Http\FormBuilderInterface;
use Centum\Interfaces\Http\RequestInterface;
use Exception;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionNamedType;
use ReflectionParameter;

class FormBuilder implements FormBuilderInterface
{
    protected readonly DataInterface $data;
    protected readonly FilesInterface $files;



    public function __construct(
        protected readonly ContainerInterface $container,
        RequestInterface $request
    ) {
        $container->set(RequestInterface::class, $request);

        $this->data  = $request->getData();
        $this->files = $request->getFiles();
    }



    /**
     * @template T of object
     * @psalm-param class-string<T> $class
     * @psalm-return T
     */
    public function build(string $class): object
    {
        $reflectionClass = new ReflectionClass($class);

        if (!$reflectionClass->hasMethod("__construct")) {
            throw new InvalidArgumentException(
                sprintf(
                    "%s does not have a constructor.",
                    $class
                )
            );
        }

        $reflectionMethod = $reflectionClass->getMethod("__construct");

        $params = $this->resolveParameters($reflectionMethod);

        $instance = $reflectionClass->newInstanceArgs($params);

        return $instance;
    }

    /**
     * @return array<int<0, max>, mixed>
     */
    protected function resolveParameters(ReflectionFunctionAbstract $method): array
    {
        $parameters = $method->getParameters();

        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            /** @var mixed */
            $resolvedParameters[] = $this->resolveParameter($parameter);
        }

        return $resolvedParameters;
    }

    protected function resolveParameter(ReflectionParameter $parameter): mixed
    {
        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            throw new Exception(
                sprintf(
                    "Parameter '%s' must have a simple named type.",
                    $parameter->getName()
                )
            );
        }

        if (!$type->isBuiltIn()) {
            $class = $type->getName();

            if ($class === FileGroupInterface::class) {
                return $this->getFromDataOrFiles($this->files, $parameter);
            }

            return $this->container->get($class);
        }

        if (!in_array($type->getName(), ["array", "string"])) {
            throw new Exception(
                sprintf(
                    "Parameter '%s' type (%s) not recognised.",
                    $parameter->getName(),
                    $type->getName()
                )
            );
        }

        return $this->getFromDataOrFiles($this->data, $parameter);
    }

    protected function getFromDataOrFiles(DataInterface|FilesInterface $dataOrFiles, ReflectionParameter $parameter): mixed
    {
        $name = $parameter->getName();

        if (!$dataOrFiles->has($name)) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new Exception(
                sprintf(
                    "'%s' is required.",
                    $name
                )
            );
        }

        return $dataOrFiles->get($name);
    }
}
