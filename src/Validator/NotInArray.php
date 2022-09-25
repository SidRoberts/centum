<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

class NotInArray implements ValidatorInterface
{
    protected readonly array $values;



    public function __construct(array $values)
    {
        $this->values = $values;
    }



    public function validate(mixed $value): array
    {
        if (in_array($value, $this->values)) {
            return [
                "Value is in the list of disallowed values.",
            ];
        }

        return [];
    }
}
