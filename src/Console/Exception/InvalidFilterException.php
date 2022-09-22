<?php

namespace Centum\Console\Exception;

use UnexpectedValueException;

class InvalidFilterException extends UnexpectedValueException
{
    protected readonly mixed $invalidFilter;



    public function __construct(mixed $invalidFilter)
    {
        $this->invalidFilter = $invalidFilter;
    }



    public function getInvalidFilter(): mixed
    {
        return $this->invalidFilter;
    }
}
