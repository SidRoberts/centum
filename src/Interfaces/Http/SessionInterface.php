<?php

namespace Centum\Interfaces\Http;

interface SessionInterface
{
    public function start(): bool;

    public function isActive(): bool;



    /**
     * @param non-empty-string $name
     */
    public function has(string $name): bool;

    /**
     * @param non-empty-string $name
     */
    public function get(string $name, mixed $defaultValue = null): mixed;

    /**
     * @param non-empty-string $name
     */
    public function set(string $name, mixed $value): void;

    /**
     * @param non-empty-string $name
     */
    public function remove(string $name): void;

    public function clear(): void;

    /**
     * @return array<non-empty-string, mixed>
     */
    public function all(): array;
}
