<?php

namespace Centum\Validator;

interface ValidatorInterface
{
    /**
     * @return bool|string[]
     */
    public function validate(mixed $value): bool | array;
}
