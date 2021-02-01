<?php

namespace Centum\Validator;

class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = preg_match("/^\d+$/", $value) !== false;

        if (!$success) {
            return [
                "Value is not an integer.",
            ];
        }

        return true;
    }
}
