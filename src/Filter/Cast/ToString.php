<?php

namespace Centum\Filter\Cast;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;
use JsonException;

class ToString implements FilterInterface
{
    public function filter(mixed $value): string
    {
        if (is_object($value) && !method_exists($value, "__toString")) {
            return serialize($value);
        }

        if (is_array($value)) {
            $json = json_encode($value);

            if ($json === false) {
                throw new JsonException();
            }

            return $json;
        }

        if (!is_null($value) && !is_object($value) && !is_scalar($value)) {
            throw new InvalidArgumentException();
        }

        return strval($value);
    }
}
