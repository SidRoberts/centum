<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = (is_scalar($value) && !is_bool($value) && preg_match("/^\d+$/", strval($value)) === 1);

        if (!$success) {
            return [
                "Value is not an integer.",
            ];
        }

        return true;
    }
}
