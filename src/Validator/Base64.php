<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is is a valid base64 string.
 */
class Base64 implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        $decodedValue = base64_decode($value, true);

        if ($decodedValue === false) {
            return [
                "Value is not a valid base64 string.",
            ];
        }

        return [];
    }
}
