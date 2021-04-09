<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsBoolean implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = is_bool($value);

        if (!$success) {
            return [
                "Value is not boolean.",
            ];
        }

        return true;
    }
}
