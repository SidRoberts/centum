<?php

namespace Centum\Validator;

class IsBoolean implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = is_bool($value);

        if (!$success) {
            return [
                "Value is not a boolean.",
            ];
        }

        return true;
    }
}
