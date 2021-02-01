<?php

namespace Centum\Validation;

class IsInteger implements ValidatorInterface
{
    public function validate(mixed $value) : bool
    {
        return preg_match("/^\d+$/", $value) !== false;
    }
}
