<?php

namespace Centum\Validator;

class EmailAddress implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = (filter_var($value, FILTER_VALIDATE_EMAIL) === $value);

        if (!$success) {
            return [
                "Value is not an email address.",
            ];
        }

        return true;
    }
}
