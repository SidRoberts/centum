<?php

namespace Centum\Interfaces\Paginator;

interface DataInterface
{
    /**
     * @return non-negative-int
     */
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
