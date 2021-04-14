<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsScalar implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = is_scalar($value);

        if (!$success) {
            return [
                "Value is not a scalar.",
            ];
        }

        return true;
    }
}
