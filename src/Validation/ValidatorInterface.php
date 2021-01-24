<?php

namespace Centum\Validation;

interface ValidatorInterface
{
    public function validate($value);

    public function getMessages() : array;
}
