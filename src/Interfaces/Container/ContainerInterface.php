<?php

namespace Centum\Interfaces\Container;

use Closure;

interface ContainerInterface
{
    /**
     * @template T
     * @psalm-param class-string<T> $class
     * @psalm-return T
     */
    public function get(string $class): object;

    public function typehintMethod(object $class, string $methodName): mixed;

    /**
     * @param Closure|callable-string $function
     */
    public function typehintFunction(Closure | string $function): mixed;



    /**
     * @param class-string $class
     * @param class-string $alias
     */
    public function addAlias(string $class, string $alias): void;

    /**
     * @param class-string $class
     */
    public function set(string $class, object $object): void;

    /**
     * @param class-string $class
     * @param Closure|callable-string $function
     */
    public function setDynamic(string $class, Closure | string $function): void;

    /**
     * @param class-string $class
     */
    public function remove(string $class): void;
}
