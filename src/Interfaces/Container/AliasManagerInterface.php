<?php

namespace Centum\Interfaces\Container;

interface AliasManagerInterface
{
    /**
     * @param class-string $class
     * @param class-string $alias
     */
    public function add(string $class, string $alias): void;

    /**
     * @param class-string $class
     *
     * @return class-string
     */
    public function get(string $class): string;

    /**
     * @param class-string $class
     */
    public function has(string $class): bool;

    /**
     * @param class-string $class
     */
    public function remove(string $class): void;



    /**
     * @return array<class-string, class-string>
     */
    public function getAll(): array;
}
