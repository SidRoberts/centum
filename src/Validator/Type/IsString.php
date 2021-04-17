<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsString implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        return [];
    }
}
