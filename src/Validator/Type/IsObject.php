<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is an object.
 */
class IsObject implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_object($value)) {
            return [
                "Value is not an object.",
            ];
        }

        return [];
    }
}
