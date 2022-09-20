<?php

namespace Centum\Validator;

class InArray implements ValidatorInterface
{
    protected array $values;



    public function __construct(array $values)
    {
        $this->values = $values;
    }



    public function validate(mixed $value): array
    {
        if (!in_array($value, $this->values)) {
            return [
                "Value is not in the list of allowed values.",
            ];
        }

        return [];
    }
}
