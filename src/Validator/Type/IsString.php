<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsString implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_string($value);

        if (!$success) {
            return [
                "Value is not a string.",
            ];
        }

        return [];
    }
}
