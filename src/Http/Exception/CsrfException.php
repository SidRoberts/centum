<?php

namespace Centum\Http\Exception;

class CsrfException extends \Exception
{
    protected readonly ?string $value;



    public function __construct(?string $value)
    {
        $this->value = $value;

        parent::__construct(
            "CSRF values did not match."
        );
    }



    public function getValue(): ?string
    {
        return $this->value;
    }
}
