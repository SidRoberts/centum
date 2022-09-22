<?php

namespace Centum\Paginator;

interface DataInterface
{
    public function getTotal(): int;

    public function toArray(): array;

    public function slice(int $offset, int $length): DataInterface;
}
