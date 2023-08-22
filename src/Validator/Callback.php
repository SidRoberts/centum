<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

/**
 * Checks if a value against a callback function. Allows custom Validators to be
 * wrapped within a callable.
 */
class Callback implements ValidatorInterface
{
    /**
     * @param callable $callable
     */
    public function __construct(
        protected $callable
    ) {
    }



    public function validate(mixed $value): array
    {
        /** @var array<string> */
        return call_user_func_array(
            $this->callable,
            [
                $value,
            ]
        );
    }
}
