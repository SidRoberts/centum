<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;

class CamelCaseToSlug implements FilterInterface
{
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        if (preg_match("/^[A-Za-z0-9]+$/", $value) !== 1) {
            throw new InvalidArgumentException("Value is not camel-case.");
        }

        return preg_replace_callback(
            "/([A-Z])/",
            function ($matches): string {
                return "-" . strtolower($matches[1]);
            },
            lcfirst($value)
        );
    }
}
