<?php

namespace Centum\Validator;

class CommandSlug implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        // Empty values are allowed.
        if ($value === "") {
            return [];
        }

        if (preg_match("/^([a-z0-9]+(?:-[a-z0-9]+)*)(?:\:[a-z0-9]+(?:-[a-z0-9]+)*)*$/", $value) !== 1) {
            return [
                "Value is not a valid slug.",
            ];
        }

        return [];
    }
}
