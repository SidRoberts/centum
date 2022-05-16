<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsA implements ValidatorInterface
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
        if (!is_a($value, $this->className)) {
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
