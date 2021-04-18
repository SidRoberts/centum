<?php

namespace Centum\Validator;

class IsRegularExpression implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (filter_var($value, FILTER_VALIDATE_REGEXP) !== $value) {
            return [
                "Value is not a regular expression.",
            ];
        }

        return [];
    }
}
