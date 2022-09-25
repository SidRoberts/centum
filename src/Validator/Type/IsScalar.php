<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

class IsScalar implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_scalar($value)) {
            return [
                "Value is not a scalar.",
            ];
        }

        return [];
    }
}
