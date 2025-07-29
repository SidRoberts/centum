<?php

namespace Centum\Interfaces\Container;

interface ServiceStorageInterface
{
    /**
     * @param class-string $class
     */
    public function has(string $class): bool;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return class-string<ServiceInterface<T>>|null
     */
    public function get(string $class): ?string;

    /**
     * @template T of object
     *
     * @param class-string<T>                   $class
     * @param class-string<ServiceInterface<T>> $service
     */
    public function set(string $class, string $service): void;

    /**
     * @param class-string $class
     */
    public function remove(string $class): void;
}
