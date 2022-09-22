<?php

namespace Centum\Validator;

class RegularExpression implements ValidatorInterface
{
    protected readonly string $pattern;



    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }



    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match($this->pattern, $value) !== 1) {
            return [
                sprintf(
                    "Value does not match '%s'.",
                    $this->pattern
                ),
            ];
        }

        return [];
    }
}
