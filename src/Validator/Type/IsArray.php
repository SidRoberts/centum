<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsArray implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_array($value)) {
            return [
                "Value is not an array.",
            ];
        }

        return [];
    }
}
