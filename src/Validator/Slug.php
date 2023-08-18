<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a slug (i.e. all lowercase, alphanumeric with dashes,
 * starting and ending with a letter or number).
 */
class Slug implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match("/^[a-z0-9]+(?:-[a-z0-9]+)*$/", $value) !== 1) {
            return [
                "Value is not a valid slug.",
            ];
        }

        return [];
    }
}
