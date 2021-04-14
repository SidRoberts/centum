<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsObject implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_object($value);

        if (!$success) {
            return [
                "Value is not an object.",
            ];
        }

        return [];
    }
}
