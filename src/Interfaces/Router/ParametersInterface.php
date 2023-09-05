<?php

namespace Centum\Interfaces\Router;

interface ParametersInterface
{
    /**
     * @param non-empty-string $name
     */
    public function get(string $name, mixed $defaultValue = null): mixed;

    /**
     * @param non-empty-string $name
     */
    public function has(string $name): bool;



    /**
     * @return array<non-empty-string, mixed>
     */
    public function toArray(): array;
}
