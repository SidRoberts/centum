<?php

namespace Centum\Container;

use Centum\Container\Exception\UnresolvableParameterException;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;

class Container
{
    protected array $objects = [];

    protected array $aliases = [];



    public function __construct()
    {
        $this->set(self::class, $this);
    }



    public function typehintClass(string $class) : object
    {
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



    public function typehintFunction(string $functionName) : mixed
    {
        $reflectionFunction = new ReflectionFunction($functionName);

        $params = $this->resolveParams($reflectionFunction);

        return $reflectionFunction->invokeArgs($class, $params);
    }



    public function addAlias(string $class, string $alias) : void
    {
        $this->aliases[$class] = $alias;
    }

    public function set(string $class, object $object) : void
    {
        $this->objects[$class] = $object;
    }



    protected function resolveParams(ReflectionMethod $method) : array
    {
        $parameters = $method->getParameters();

        $params = [];

        foreach ($parameters as $parameter) {
            $params[] = $this->resolveParam($parameter);
        }

        return $params;
    }

    protected function resolveParam(ReflectionParameter $parameter) : mixed
    {
        $type = $parameter->getType();

        if ($type === null || $type->isBuiltIn()) {
            if (!$parameter->allowsNull()) {
                $name = $parameter->getName();

                throw new UnresolvableParameterException($name);
            }

            return null;
        }

        $class = $type->getName();

        return $this->typehintClass($class);
    }
}
