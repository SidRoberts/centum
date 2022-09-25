<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (is_bool($value) || !is_scalar($value) || preg_match("/^\d+$/", strval($value)) !== 1) {
            return [
                "Value is not an integer.",
            ];
        }

        return [];
    }
}
