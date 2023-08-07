<?php

namespace Centum\Interfaces\Paginator;

interface DataInterface
{
    public function getTotal(): int;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @return array<mixed>
     */
    public function slice(int $offset, int $length): array;
}
