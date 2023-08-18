<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is `null`.
 */
class IsNull implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_null($value)) {
            return [
                "Value is not null.",
            ];
        }

        return [];
    }
}
