<?php

namespace Centum\Validator;

interface ValidatorInterface
{
    public function validate(mixed $value): bool | array;
}
