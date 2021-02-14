<?php

namespace Centum\Container;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;

class Resolver
{
    protected Container $container;



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    /**
     * Typehint a class using the properties in its constructor. If no
     * constructor is present, a new instance is made anyway.
     */
    public function typehintClass(string $className, array $custom = [])
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->hasMethod("__construct")) {
            return $reflectionClass->newInstance();
        }

        $reflectionMethod = $reflectionClass->getMethod("__construct");

        $reflectionParameters = $reflectionMethod->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return $reflectionClass->newInstanceArgs($params);
    }



    /**
     * Typehint a class method.
     */
    public function typehintMethod($class, string $method, array $custom = [])
    {
        $className = get_class($class);

        $reflectionMethod = new ReflectionMethod($className, $method);

        $reflectionParameters = $reflectionMethod->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return call_user_func_array(
            [
                $class,
                $method,
            ],
            $params
        );
    }



    public function typehintService(Service $service)
    {
        return $this->typehintMethod($service, "resolve");
    }




    /**
     * Typehint a function.
     */
    public function typehintFunction(string $functionName, array $custom = [])
    {
        $reflectionFunction = new ReflectionFunction($functionName);

        $reflectionParameters = $reflectionFunction->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return call_user_func_array(
            $functionName,
            $params
        );
    }


    protected function resolveParams(array $reflectionParameters, array $custom) : array
    {
        $params = [];

        foreach ($reflectionParameters as $reflectionParameter) {
            if (!($reflectionParameter instanceof ReflectionParameter)) {
                throw new InvalidArgumentException();
            }

            $name = $reflectionParameter->getName();

            $params[] = $custom[$name] ?? $this->resolveParam($reflectionParameter);
        }

        return $params;
    }



    protected function resolveParam(ReflectionParameter $reflectionParameter)
    {
        $name = $reflectionParameter->getName();

        if ($name === "container") {
            return $this->container;
        }

        $service = $this->container->get($name);

        return $service;
    }
}
