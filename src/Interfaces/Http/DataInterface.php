<?php

namespace Centum\Interfaces\Http;

/**
 * @psalm-immutable
 */
interface DataInterface
{
    /**
     * @param non-empty-string $name
     */
    public function get(string $name): mixed;

    /**
     * @param non-empty-string $name
     */
    public function has(string $name): bool;



    /**
     * @return array<non-empty-string, mixed>
     */
    public function toArray(): array;
}
