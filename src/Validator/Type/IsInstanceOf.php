<?php

namespace Centum\Validator\Type;

use Centum\Interfaces\Validator\ValidatorInterface;

class IsInstanceOf implements ValidatorInterface
{
    /** @var class-string */
    protected string $className;



    /**
     * @param class-string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }



    public function validate(mixed $value): array
    {
        if (!is_object($value)) {
            return [
                "Value is not an object.",
            ];
        }

        if (!($value instanceof $this->className)) {
            return [
                sprintf(
                    "Value is not an instance of %s.",
                    $this->className
                ),
            ];
        }

        return [];
    }
}
