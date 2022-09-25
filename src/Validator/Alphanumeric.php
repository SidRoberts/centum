<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

class Alphanumeric implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match("/^[A-Za-z0-9]+$/", $value) !== 1) {
            return [
                "Value is not alphanumeric.",
            ];
        }

        return [];
    }
}
