<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a single character.
 */
class IsCharacter implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (mb_strlen($value) !== 1) {
            return [
                "Value is not a character.",
            ];
        }

        return [];
    }
}
