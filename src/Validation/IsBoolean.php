<?php

namespace Centum\Validation;

class IsBoolean implements ValidatorInterface
{
    public function validate(mixed $value) : bool
    {
        return is_bool($value);
    }
}
