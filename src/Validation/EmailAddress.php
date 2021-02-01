<?php

namespace Centum\Validation;

class EmailAddress implements ValidatorInterface
{
    public function validate(mixed $value) : bool
    {
        return (filter_var($value, FILTER_VALIDATE_EMAIL) === $value);
    }
}
