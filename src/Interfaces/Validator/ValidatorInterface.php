<?php

namespace Centum\Interfaces\Validator;

interface ValidatorInterface
{
    /**
     * Returns an array of string messages explaining any violations or reasons
     * why the validation failed.
     *
     * @return list<non-empty-string>
     */
    public function validate(mixed $value): array;
}
