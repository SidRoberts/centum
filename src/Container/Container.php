<?php

namespace Centum\Container;

use Centum\Container\Exception\InstantiateInterfaceException;
use Centum\Interfaces\Container\AliasManagerInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Container\ResolverGroupInterface;
use Centum\Interfaces\Container\ServiceInterface;
use Centum\Interfaces\Container\ServiceStorageInterface;
use Closure;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

class Container implements ContainerInterface
{
    protected readonly AliasManagerInterface $aliasManager;
    protected readonly ResolverGroupInterface $resolverGroup;
    protected readonly ObjectStorageInterface $objectStorage;
    protected readonly ServiceStorageInterface $serviceStorage;



    public function __construct(
        AliasManagerInterface $aliasManager = null,
        ResolverGroupInterface $resolverGroup = null,
        ObjectStorageInterface $objectStorage = null,
        ServiceStorageInterface $serviceStorage = null
    ) {
        $this->aliasManager   = $aliasManager   ?? new AliasManager();
        $this->resolverGroup  = $resolverGroup  ?? new ResolverGroup();
        $this->objectStorage  = $objectStorage  ?? new ObjectStorage();
        $this->serviceStorage = $serviceStorage ?? new ServiceStorage();

        $this->objectStorage->set(ContainerInterface::class, $this);
    }



    public function getAliasManager(): AliasManagerInterface
    {
        return $this->aliasManager;
    }

    public function getResolverGroup(): ResolverGroupInterface
    {
        return $this->resolverGroup;
    }

    public function getObjectStorage(): ObjectStorageInterface
    {
        return $this->objectStorage;
    }

    public function getServiceStorage(): ServiceStorageInterface
    {
        return $this->serviceStorage;
    }



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     *
     * @throws InstantiateInterfaceException
     */
    public function get(string $class): object
    {
        if (!$this->objectStorage->has($class)) {
            $service = $this->serviceStorage->get($class);

            if ($service !== null) {
                $object = $this->typehintService($service);
            } else {
                $object = $this->typehintClass($class);
            }

            $this->objectStorage->set($class, $object);
        }

        /** @var T */
        return $this->objectStorage->get($class);
    }



    /**
     * @template T of object
     *
     * @param class-string<ServiceInterface<T>> $serviceClass
     *
     * @return T
     *
     * @throws InstantiateInterfaceException
     */
    public function typehintService(string $serviceClass): object
    {
        $service = $this->typehintClass($serviceClass);

        return $service->build();
    }



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     *
     * @throws InstantiateInterfaceException
     */
    public function typehintClass(string $class): object
    {
        /** @var class-string<T> */
        $alias = $this->aliasManager->get($class);

        if (interface_exists($alias)) {
            throw new InstantiateInterfaceException($alias);
        }

        $reflectionClass = new ReflectionClass($alias);

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return $reflectionClass->newInstance();
        }

        $params = $this->resolveParams($constructor);

        return $reflectionClass->newInstanceArgs($params);
    }

    public function typehintMethod(object $class, string $methodName): mixed
    {
        $reflectionMethod = new ReflectionMethod($class, $methodName);

        $params = $this->resolveParams($reflectionMethod);

        return $reflectionMethod->invokeArgs($class, $params);
    }



    public function typehintFunction(Closure|string $function): mixed
    {
        $reflectionFunction = new ReflectionFunction($function);

        $params = $this->resolveParams($reflectionFunction);

        return $reflectionFunction->invokeArgs($params);
    }



    /**
     * @return array<non-negative-int, mixed>
     */
    protected function resolveParams(ReflectionFunctionAbstract $method): array
    {
        $parameters = $method->getParameters();

        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            /** @var mixed */
            $resolvedParameters[] = $this->resolverGroup->resolve($parameter, $this);
        }

        return $resolvedParameters;
    }
}
