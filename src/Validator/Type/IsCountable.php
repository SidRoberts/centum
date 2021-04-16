<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsCountable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_countable($value);

        if (!$success) {
            return [
                "Value is not countable.",
            ];
        }

        return [];
    }
}
