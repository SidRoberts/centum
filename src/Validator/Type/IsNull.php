<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsNull implements ValidatorInterface
{
    public function validate(mixed $value): bool | array
    {
        $success = is_null($value);

        if (!$success) {
            return [
                "Value is not null.",
            ];
        }

        return true;
    }
}
