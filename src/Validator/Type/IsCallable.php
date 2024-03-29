<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a callable.
 */
class IsCallable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_callable($value)) {
            return [
                "Value is not a callable.",
            ];
        }

        return [];
    }
}
