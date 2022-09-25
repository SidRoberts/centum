<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

class LanguageCode implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match("/^[a-z]{2}(?:\-[A-Z]{2})$/", $value) !== 1) {
            return [
                "Value is not an ISO language code.",
            ];
        }

        return [];
    }
}
