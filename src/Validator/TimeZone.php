<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;
use DateTimeZone;

/**
 * Checks if a value is a valid time zone identifier.
 */
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

        if (!in_array($value, $timeZones, true)) {
            return [
                "Value is not a valid time zone.",
            ];
        }

        return [];
    }
}
