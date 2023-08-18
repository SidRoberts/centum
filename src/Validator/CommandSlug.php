<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is a Command slug (i.e. all lowercase, alphanumeric with
 * dashes and colons, starting and ending with a letter or number).
 *
 * This differs from `Centum\Validator\Slug` in that colons are also allowed.
 */
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
