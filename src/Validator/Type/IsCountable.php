<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is countable.
 */
class IsCountable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_countable($value)) {
            return [
                "Value is not countable.",
            ];
        }

        return [];
    }
}
