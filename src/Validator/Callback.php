<?php

namespace Centum\Validator;

use Centum\Interfaces\Validator\ValidatorInterface;

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
        /** @var string[] */
        return call_user_func_array(
            $this->callable,
            [
                $value,
            ]
        );
    }
}
