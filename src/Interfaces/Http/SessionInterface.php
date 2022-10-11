<?php

namespace Centum\Interfaces\Http;

interface SessionInterface
{
    public function start(): bool;

    public function isActive(): bool;



    public function has(string $name): bool;

    public function get(string $name, mixed $defaultValue = null): mixed;

    public function set(string $name, mixed $value): void;

    public function remove(string $name): void;

    public function clear(): void;

    /**
     * @return array<string, mixed>
     */
    public function all(): array;
}
