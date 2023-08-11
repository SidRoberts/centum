<?php

namespace Centum\Console;

use Centum\Console\Exception\CommandParameterRequiredException;
use Centum\Console\Exception\NotACommandException;
use Centum\Console\Exception\ParameterMustHaveSimpleTypeException;
use Centum\Console\Exception\ParameterNotRecognisedException;
use Centum\Interfaces\Console\CommandBuilderInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use Centum\Interfaces\Container\ContainerInterface;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionNamedType;
use ReflectionParameter;

class CommandBuilder implements CommandBuilderInterface
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }



    /**
     * @param class-string $class
     */
    public function build(string $class, ArgumentsInterface $arguments): CommandInterface
    {
        $reflectionClass = new ReflectionClass($class);

        if (!$reflectionClass->isSubclassOf(CommandInterface::class)) {
            throw new NotACommandException($class);
        }

        if (!$reflectionClass->hasMethod("__construct")) {
            return $reflectionClass->newInstance();
        }

        $reflectionMethod = $reflectionClass->getMethod("__construct");

        $params = $this->resolveParameters($reflectionMethod, $arguments);

        /**
         * @psalm-suppress UnnecessaryVarAnnotation
         * @var CommandInterface
         */
        $instance = $reflectionClass->newInstanceArgs($params);

        return $instance;
    }

    /**
     * @return array<int<0, max>, mixed>
     */
    protected function resolveParameters(ReflectionFunctionAbstract $method, ArgumentsInterface $arguments): array
    {
        $parameters = $method->getParameters();

        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            /** @var mixed */
            $resolvedParameters[] = $this->resolveParameter($parameter, $arguments);
        }

        return $resolvedParameters;
    }

    protected function resolveParameter(ReflectionParameter $parameter, ArgumentsInterface $arguments): mixed
    {
        $type = $parameter->getType();

        if (!($type instanceof ReflectionNamedType)) {
            throw new ParameterMustHaveSimpleTypeException($parameter);
        }

        if (!$type->isBuiltIn()) {
            $class = $type->getName();

            return $this->container->get($class);
        }

        $name = $parameter->getName();

        $name = preg_replace_callback(
            "/([A-Z])/",
            function ($matches): string {
                return "-" . strtolower($matches[1]);
            },
            $name
        );

        if ($type->getName() === "bool") {
            return $arguments->hasParameter($name);
        }

        if ($type->getName() !== "string") {
            throw new ParameterNotRecognisedException($parameter);
        }

        if (!$arguments->hasParameter($name)) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            throw new CommandParameterRequiredException($name);
        }

        return $arguments->getParameter($name);
    }
}
