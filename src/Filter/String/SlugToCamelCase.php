<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class SlugToCamelCase implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        if (preg_match("/^[a-z0-9]+(?:-[a-z0-9]+)*$/", $value) !== 1) {
            throw new InvalidArgumentException("Value is not a valid slug.");
        }

        return preg_replace_callback(
            "/\-([a-z0-9])/",
            function ($matches): string {
                return mb_strtoupper($matches[1]);
            },
            $value
        );
    }
}
