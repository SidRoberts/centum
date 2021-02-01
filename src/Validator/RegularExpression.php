<?php

namespace Centum\Validator;

class RegularExpression implements ValidatorInterface
{
    protected string $pattern;



    public function __construct(string $pattern)
    {
        //TODO Check pattern

        $this->pattern = $pattern;
    }



    public function validate(mixed $value): bool | array
    {
        $success = preg_match($this->pattern, $value) !== false;

        if (!$success) {
            return [
                "Value does not match the regular expression.",
            ];
        }

        return true;
    }
}
