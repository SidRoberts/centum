<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class Base64Encode implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        return base64_encode($value);
    }
}
