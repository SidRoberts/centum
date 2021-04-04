<?php

namespace Centum\Validator;

class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = (is_scalar($value) && preg_match("/^\d+$/", strval($value)) !== false);

        if (!$success) {
            return [
                "Value is not an integer.",
            ];
        }

        return true;
    }
}
