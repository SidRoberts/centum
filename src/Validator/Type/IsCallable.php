<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsCallable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_callable($value);

        if (!$success) {
            return [
                "Value is not a callable.",
            ];
        }

        return [];
    }
}
