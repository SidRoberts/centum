<?php

namespace Centum\Interfaces\Console;

interface ParametersInterface
{
    public function get(string $name, mixed $defaultValue = null): mixed;

    public function set(string $name, mixed $value): void;

    public function has(string $name): bool;



    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
