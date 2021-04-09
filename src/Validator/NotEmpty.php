<?php

namespace Centum\Validator;

class NotEmpty implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = !empty($value);

        if (!$success) {
            return [
                "Value is required and can't be empty.",
            ];
        }

        return true;
    }
}
