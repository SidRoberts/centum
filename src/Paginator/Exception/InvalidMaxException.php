<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidMaxException extends InvalidArgumentException
{
    protected int $max;



    public function __construct(int $max)
    {
        $this->max = $max;

        parent::__construct("Max must be a positive integer.");
    }



    public function getMax(): int
    {
        return $this->max;
    }
}
