<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

class IsResource implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_resource($value)) {
            return [
                "Value is not a resource.",
            ];
        }

        return [];
    }
}
