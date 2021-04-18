<?php

namespace Centum\Validator;

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
