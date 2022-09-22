<?php

namespace Centum\Validator;

class Callback implements ValidatorInterface
{
    /** @var callable */
    protected $callable;



    public function __construct(callable $callable)
    {
        $this->callable = $callable;
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
