<?php

namespace Centum\Console\Exception;

use UnexpectedValueException;

class InvalidFilterException extends UnexpectedValueException
{
    public function __construct(
        protected readonly mixed $invalidFilter
    ) {
    }



    public function getInvalidFilter(): mixed
    {
        return $this->invalidFilter;
    }
}
