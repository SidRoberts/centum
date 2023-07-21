<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidMaxException extends InvalidArgumentException
{
    public function __construct(
        protected readonly int $max
    ) {
        parent::__construct("Max must be a positive integer.");
    }



    public function getMax(): int
    {
        return $this->max;
    }
}
