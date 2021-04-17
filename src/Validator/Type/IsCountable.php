<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

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
