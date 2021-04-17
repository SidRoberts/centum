<?php

namespace Centum\Validator;

class EmailAddress implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL) !== $value) {
            return [
                "Value is not an email address.",
            ];
        }

        return [];
    }
}
