<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsIterable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_iterable($value);

        if (!$success) {
            return [
                "Value is not iterable.",
            ];
        }

        return [];
    }
}
