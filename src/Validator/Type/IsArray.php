<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsArray implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_array($value);

        if (!$success) {
            return [
                "Value is not an array.",
            ];
        }

        return [];
    }
}
