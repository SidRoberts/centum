<?php

namespace Centum\Filter\String;

use Centum\Filter\FilterInterface;
use InvalidArgumentException;

class Prefix implements FilterInterface
{
    protected string $prefix;



    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }



    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return $this->prefix . $value;
    }
}
