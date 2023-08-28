<?php

namespace Centum\Interfaces\Validator;

interface ValidatorInterface
{
    /**
     * @return list<string>
     */
    public function validate(mixed $value): array;
}
