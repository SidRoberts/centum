<?php

namespace Centum\Paginator\Data;

use Centum\Paginator\DataInterface;
use Centum\Paginator\Exception\InvalidTotalException;

class ArrayData implements DataInterface
{
    protected array $data;
    protected int $total;



    public function __construct(array $data, int $total)
    {
        if ($total < 0) {
            throw new InvalidTotalException($total);
        }

        $this->data = $data;
        $this->total = $total;
    }



    public function getTotal(): int
    {
        return $this->total;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function slice(int $offset, int $length): DataInterface
    {
        return new ArrayData(
            array_slice($this->data, $offset, $length),
            $this->total
        );
    }
}
