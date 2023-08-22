<?php

namespace Centum\Interfaces\Validator;

interface ValidatorInterface
{
    /**
     * @return array<string>
     */
    public function validate(mixed $value): array;
}
