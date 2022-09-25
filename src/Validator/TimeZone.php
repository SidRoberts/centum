<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use DateTimeZone;

class TimeZone implements ValidatorInterface
{
    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        $timeZones = DateTimeZone::listIdentifiers();

        if (!in_array($value, $timeZones)) {
            return [
                "Value is not a valid time zone.",
            ];
        }

        return [];
    }
}
