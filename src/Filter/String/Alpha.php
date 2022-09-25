<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Alpha implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return preg_replace("/[^A-Za-z]+/", "", $value);
    }
}
