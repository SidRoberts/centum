<?php

namespace Centum\Validator\Type;

use Centum\Validator\ValidatorInterface;

class IsA implements ValidatorInterface
{
    /**
     * @var class-string
     */
    protected $className;



    /**
     * @param class-string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }



    public function validate(mixed $value): array
    {
        $success = is_a($value, $this->className);

        if (!$success) {
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
