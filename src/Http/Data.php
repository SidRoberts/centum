<?php

namespace Centum\Http;

use Centum\Interfaces\Http\DataInterface;

class Data implements DataInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        protected readonly array $data
    ) {
    }



    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->data[$name] ?? $defaultValue;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }



    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
