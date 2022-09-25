<?php

namespace Centum\Interfaces\Validator;

interface ValidatorInterface
{
    /**
     * @return string[]
     */
    public function validate(mixed $value): array;
}
