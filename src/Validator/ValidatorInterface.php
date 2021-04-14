<?php

namespace Centum\Validator;

interface ValidatorInterface
{
    /**
     * @return string[]
     */
    public function validate(mixed $value): array;
}
