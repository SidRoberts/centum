<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use Closure;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;

class Container
{
    /**
     * @var object[]
     */
    protected array $objects = [];

    protected array $aliases = [];



    public function __construct()
    {
        $this->set(self::class, $this);
    }



    /**
     * @param class-string $class
     */
    public function typehintClass(string $class) : object
    {
        /**
         * @var class-string
         */
        $class = $this->aliases[$class] ?? $class;

        if (!isset($this->objects[$class])) {
            $reflectionClass = new ReflectionClass($class);

            if ($reflectionClass->hasMethod("__construct")) {
                $reflectionMethod = $reflectionClass->getMethod("__construct");

                $params = $this->resolveParams($reflectionMethod);

                $this->objects[$class] = $reflectionClass->newInstanceArgs($params);
            } else {
                $this->objects[$class] = $reflectionClass->newInstance();
            }
        }

        return $this->objects[$class];
    }



    public function typehintMethod(object $class, string $methodName) : mixed
    {
        $reflectionMethod = new ReflectionMethod($class, $methodName);

        $params = $this->resolveParams($reflectionMethod);

        return $reflectionMethod->invokeArgs($class, $params);
    }



    /**
     * @param Closure|callable-string $function
     */
    public function typehintFunction(Closure|string $function) : mixed
    {
        $reflectionFunction = new ReflectionFunction($function);

        $params = $this->resolveParams($reflectionFunction);

        return $reflectionFunction->invokeArgs($params);
    }



    public function addAlias(string $class, string $alias) : void
    {
        $this->aliases[$class] = $alias;
    }

    public function set(string $class, object $object) : void
    {
        $this->objects[$class] = $object;
    }

    /**
     * @param Closure|callable-string $function
     */
    public function setDynamic(string $class, Closure|string $function) : void
    {
        /**
         * @var object
         */
        $this->objects[$class] = $this->typehintFunction($function);
    }



    /**
     * @return array<int, mixed>
     */
    protected function resolveParams(ReflectionFunctionAbstract $method) : array
    {
        $parameters = $method->getParameters();

        $params = [];

        foreach ($parameters as $parameter) {
            /**
             * @var mixed
             */
            $params[] = $this->resolveParam($parameter);
        }

        return $params;
    }

    protected function resolveParam(ReflectionParameter $parameter) : mixed
    {
        $type = $parameter->getType();

        if ($type === null && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if (!($type instanceof ReflectionNamedType)) {
            $name = $parameter->getName();

            throw new UnresolvableParameterException($name);
        }

        if ($type->isBuiltIn()) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            $name = $parameter->getName();

            throw new UnresolvableParameterException($name);
        }

        /**
         * @var class-string $class
         */
        $class = $type->getName();

        return $this->typehintClass($class);
    }
}
