<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is in an array of values.
 */
class InArray implements ValidatorInterface
{
    /**
     * @param array<mixed> $values
     */
    public function __construct(
        protected readonly array $values
    ) {
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
