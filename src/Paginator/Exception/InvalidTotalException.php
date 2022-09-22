<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidTotalException extends InvalidArgumentException
{
    protected readonly int $total;



    public function __construct(int $total)
    {
        $this->total = $total;

        parent::__construct("Total must be a positive integer.");
    }



    public function getTotal(): int
    {
        return $this->total;
    }
}
