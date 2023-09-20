<?php

namespace Centum\Http;

use Centum\Interfaces\Http\DataInterface;
use OutOfRangeException;

/**
 * @psalm-immutable
 */
class Data implements DataInterface
{
    /**
     * @param array<non-empty-string, mixed> $data
     */
    public function __construct(
        protected readonly array $data
    ) {
    }



    /**
     * @throws OutOfRangeException
     */
    public function get(string $name): mixed
    {
        if (!array_key_exists($name, $this->data)) {
            throw new OutOfRangeException($name);
        }

        return $this->data[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }



    public function toArray(): array
    {
        return $this->data;
    }
}
