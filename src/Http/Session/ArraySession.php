<?php

namespace Centum\Http\Session;

use Centum\Interfaces\Http\SessionInterface;

class ArraySession implements SessionInterface
{
    /**
     * @var array<non-empty-string, mixed>
     */
    protected array $data = [];



    public function start(): bool
    {
        return true;
    }

    public function isActive(): bool
    {
        return true;
    }



    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->data[$name] ?? $defaultValue;
    }

    public function set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function remove(string $name): void
    {
        unset($this->data[$name]);
    }

    public function clear(): void
    {
        $this->data = [];
    }

    public function all(): array
    {
        return $this->data;
    }
}
