<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a valid email address.
 */
class EmailAddress implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL) !== $value) {
            return [
                "Value is not an email address.",
            ];
        }

        return [];
    }
}
