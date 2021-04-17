<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsCallable implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_callable($value)) {
            return [
                "Value is not a callable.",
            ];
        }

        return [];
    }
}
