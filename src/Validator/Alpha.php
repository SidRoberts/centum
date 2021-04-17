<?php

namespace Centum\Validator;

class Alpha implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match("/^[A-Za-z]+$/", $value) !== 1) {
            return [
                "Value must only contain letters.",
            ];
        }

        return [];
    }
}
