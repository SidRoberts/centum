<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

class NotInArray implements ValidatorInterface
{
    /**
     * @var array<mixed>
     */
    protected readonly array $values;



    /**
     * @param array<mixed> $values
     */
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
