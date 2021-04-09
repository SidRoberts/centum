<?php

namespace Centum\Validator;

class RegularExpression implements ValidatorInterface
{
    protected string $pattern;



    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }



    public function validate(mixed $value): bool | array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        $success = (preg_match($this->pattern, $value) === 1);

        if (!$success) {
            return [
                sprintf(
                    "Value does not match '%s'.",
                    $this->pattern
                ),
            ];
        }

        return true;
    }
}
