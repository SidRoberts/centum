<?php

namespace Centum\Container;

use Centum\Interfaces\Container\ObjectStorageInterface;

class ObjectStorage implements ObjectStorageInterface
{
    /**
     * @var class-string-map<T, T>
     */
    protected array $objects = [];



    public function has(string $class): bool
    {
        return isset($this->objects[$class]);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T|null
     */
    public function get(string $class): object|null
    {
        return $this->objects[$class] ?? null;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param T               $object
     */
    public function set(string $class, object $object): void
    {
        $this->objects[$class] = $object;
    }

    public function remove(string $class): void
    {
        unset($this->objects[$class]);
    }
}
