<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsObject implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_object($value)) {
            return [
                "Value is not an object.",
            ];
        }

        return [];
    }
}
