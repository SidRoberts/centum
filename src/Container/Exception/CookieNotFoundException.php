<?php

namespace Centum\Container\Exception;

class CookieNotFoundException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
        parent::__construct(
            sprintf(
                "Unable to find cookie with the ID of '%s'.",
                $name
            )
        );
    }



    public function getName(): string
    {
        return $this->name;
    }
}
