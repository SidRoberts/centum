<?php

namespace Centum\Interfaces\Container;

use Closure;

interface ContainerInterface
{
    public function getAliasManager(): AliasManagerInterface;

    public function getResolverGroup(): ResolverGroupInterface;

    public function getObjectStorage(): ObjectStorageInterface;

    public function getServiceStorage(): ServiceStorageInterface;



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function get(string $class): object;



    /**
     * @template T of object
     *
     * @param class-string<ServiceInterface<T>> $serviceClass
     *
     * @return T
     */
    public function typehintService(string $serviceClass): object;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function typehintClass(string $class): object;

    /**
     * @param non-empty-string $methodName
     */
    public function typehintMethod(object $class, string $methodName): mixed;

    /**
     * @param Closure|callable-string $function
     */
    public function typehintFunction(Closure|string $function): mixed;
}
