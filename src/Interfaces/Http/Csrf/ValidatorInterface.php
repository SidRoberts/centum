<?php

namespace Centum\Interfaces\Http\Csrf;

interface ValidatorInterface
{
    public function validate(): void;
}
