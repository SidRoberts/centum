<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

class IsCharacter implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (strlen($value) !== 1) {
            return [
                "Value is not a character.",
            ];
        }

        return [];
    }
}
