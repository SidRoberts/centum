<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is an instance of a particular class.
 */
class IsA implements ValidatorInterface
{
    /**
     * @param class-string $className
     */
    public function __construct(
        protected readonly string $className
    ) {
    }



    public function validate(mixed $value): array
    {
        if (!is_object($value) || !is_a($value, $this->className)) {
            return [
                sprintf(
                    "Value is not %s or a descendent of it.",
                    $this->className
                ),
            ];
        }

        return [];
    }
}
