<?php

namespace Centum\Validator;

class ZipCode implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        $success = preg_match("/^\d{5}(-?\d{4})?$/", $value);

        if (!$success) {
            return [
                "Value is not a valid zip code.",
            ];
        }

        return [];
    }
}
