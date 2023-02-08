<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

class Opposite implements ValidatorInterface
{
    protected ValidatorInterface $validator;



    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }



    public function validate(mixed $value): array
    {
        $violations = $this->validator->validate($value);

        if (count($violations) === 0) {
            return [
                "not valid",
            ];
        }

        return [];
    }
}
