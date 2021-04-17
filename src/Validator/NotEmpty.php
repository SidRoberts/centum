<?php

namespace Centum\Validator;

class NotEmpty implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (empty($value)) {
            return [
                "Value is required and can't be empty.",
            ];
        }

        return [];
    }
}
