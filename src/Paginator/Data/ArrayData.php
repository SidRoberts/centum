<?php

namespace Centum\Paginator\Data;

use Centum\Interfaces\Paginator\DataInterface;

class ArrayData implements DataInterface
{
    /**
     * @param array<mixed> $data
     */
    public function __construct(
        protected readonly array $data
    ) {
    }



    public function getTotal(): int
    {
        return count($this->data);
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    public function slice(int $offset, int $length): array
    {
        return array_slice($this->data, $offset, $length);
    }
}
