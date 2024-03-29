<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value is matches a regular expression.
 */
class RegularExpression implements ValidatorInterface
{
    /**
     * @param non-empty-string $pattern
     */
    public function __construct(
        protected readonly string $pattern
    ) {
    }



    public function validate(mixed $value): array
    {
        if (!is_string($value)) {
            return [
                "Value is not a string.",
            ];
        }

        if (preg_match($this->pattern, $value) !== 1) {
            return [
                sprintf(
                    "Value does not match '%s'.",
                    $this->pattern
                ),
            ];
        }

        return [];
    }
}
