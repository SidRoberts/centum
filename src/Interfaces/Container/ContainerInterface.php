<?php

namespace Centum\Interfaces\Container;

use Closure;

interface ContainerInterface
{
    /**
     * @template T of object
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    public function get(string $class): object;

    /**
     * @param non-empty-string $methodName
     */
    public function typehintMethod(object $class, string $methodName): mixed;

    /**
     * @param Closure|callable-string $function
     */
    public function typehintFunction(Closure | string $function): mixed;



    /**
     * @param interface-string $interface
     * @param class-string $alias
     */
    public function addAlias(string $interface, string $alias): void;

    /**
     * @param interface-string $interface
     */
    public function set(string $interface, object $object): void;

    /**
     * @param interface-string $interface
     * @param Closure|callable-string $function
     */
    public function setDynamic(string $interface, Closure | string $function): void;

    /**
     * @param interface-string $interface
     */
    public function remove(string $interface): void;



    public function addResolver(ResolverInterface $resolver): void;
}
