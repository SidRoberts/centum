<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use Exception;
use InvalidArgumentException;

class Alphanumeric implements FilterInterface
{
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        $value = preg_replace("/[^A-Za-z0-9]+/", "", $value);

        if ($value === null) {
            throw new Exception("preg_replace() encountered an error.");
        }

        return $value;
    }
}
