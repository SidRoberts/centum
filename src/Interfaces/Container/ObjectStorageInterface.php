<?php

namespace Centum\Interfaces\Container;

interface ObjectStorageInterface
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
     * @return T|null
     */
    public function get(string $class): ?object;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param T               $object
     */
    public function set(string $class, object $object): void;

    /**
     * @param class-string $class
     */
    public function remove(string $class): void;
}
