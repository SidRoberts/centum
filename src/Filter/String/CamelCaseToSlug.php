<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;
use RuntimeException;

class CamelCaseToSlug implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function filter(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        if (preg_match("/^[A-Za-z0-9]+$/", $value) !== 1) {
            throw new InvalidArgumentException("Value is not camel-case.");
        }

        $slug = preg_replace_callback(
            "/([A-Z])/",
            function ($matches): string {
                return "-" . mb_strtolower($matches[1]);
            },
            lcfirst($value)
        );

        if ($slug === null) {
            throw new RuntimeException("Failed to convert camel-case to slug.");
        }

        return $slug;
    }
}
