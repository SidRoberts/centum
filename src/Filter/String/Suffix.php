<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Suffix implements FilterInterface
{
    protected string $suffix;



    public function __construct(string $suffix)
    {
        $this->suffix = $suffix;
    }



    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return $value . $this->suffix;
    }
}
