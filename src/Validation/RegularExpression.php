<?php

namespace Centum\Validation;

class RegularExpression implements ValidatorInterface
{
    protected string $pattern;



    public function __construct(string $pattern)
    {
        //TODO Check pattern

        $this->pattern = $pattern;
    }



    public function validate(mixed $value) : bool
    {
        return preg_match($this->pattern, $value) !== false;
    }
}
