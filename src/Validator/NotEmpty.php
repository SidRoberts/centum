<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is not empty.
 */
class NotEmpty implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (empty($value)) {
            return [
                "Value is required and can't be empty.",
            ];
        }

        return [];
    }
}
