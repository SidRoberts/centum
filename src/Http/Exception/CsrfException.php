<?php

namespace Centum\Http\Exception;

class CsrfException extends \Exception
{
    public function __construct(
        protected readonly ?string $value
    ) {
        parent::__construct(
            "CSRF values did not match."
        );
    }



    public function getValue(): ?string
    {
        return $this->value;
    }
}
