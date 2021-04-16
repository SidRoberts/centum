<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsResource implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        $success = is_resource($value);

        if (!$success) {
            return [
                "Value is not a resource.",
            ];
        }

        return [];
    }
}
