<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a valid US zip code (either in the form of 12345 or
 * 12345-6789).
 */
class ZipCode implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match("/^\d{5}(-?\d{4})?$/", $value) !== 1) {
            return [
                "Value is not a valid zip code.",
            ];
        }

        return [];
    }
}
