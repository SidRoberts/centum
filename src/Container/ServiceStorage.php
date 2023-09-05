<?php

namespace Centum\Container;

use Centum\Interfaces\Container\ServiceInterface;
use Centum\Interfaces\Container\ServiceStorageInterface;

class ServiceStorage implements ServiceStorageInterface
{
    /**
     * @var array<class-string, class-string<ServiceInterface>>
     */
    protected array $services = [];



    /**
     * @param class-string $class
     */
    public function has(string $class): bool
    {
        return isset($this->services[$class]);
    }

    /**
     * @template T of object
     *
     * @param class-string $class<T>
     *
     * @return class-string<ServiceInterface<T>>|null
     */
    public function get(string $class): string|null
    {
        /** @var class-string<ServiceInterface<T>>|null */
        return $this->services[$class] ?? null;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param class-string<ServiceInterface<T>> $service
     */
    public function set(string $class, string $service): void
    {
        $this->services[$class] = $service;
    }

    /**
     * @param class-string $class
     */
    public function remove(string $class): void
    {
        unset($this->services[$class]);
    }
}
