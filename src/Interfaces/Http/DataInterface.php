<?php

namespace Centum\Interfaces\Http;

interface DataInterface
{
    public function get(string $name, mixed $defaultValue = null): mixed;

    public function has(string $name): bool;



    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
