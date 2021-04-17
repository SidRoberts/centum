<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsBoolean implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_bool($value)) {
            return [
                "Value is not boolean.",
            ];
        }

        return [];
    }
}
