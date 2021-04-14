<?php

namespace Centum\Validator;

class IsInstanceOf implements ValidatorInterface
{
    /**
     * @var class-string
     */
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
        $success = is_object($value) && ($value instanceof $this->className);

        if (!$success) {
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
