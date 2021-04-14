<?php

namespace Centum\Validator;

class Alphanumeric implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        $success = preg_match("/^[A-Za-z0-9]+$/", $value);

        if (!$success) {
            return [
                "Value is not alphanumeric.",
            ];
        }

        return [];
    }
}
