<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is not in an array of values.
 */
class NotInArray implements ValidatorInterface
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
        if (in_array($value, $this->values)) {
            return [
                "Value is in the list of disallowed values.",
            ];
        }

        return [];
    }
}
