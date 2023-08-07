<?php

namespace Centum\Router\Exception;

class ReplacementNotFoundException extends \Exception
{
    public function __construct(
        protected readonly string $key
    ) {
        $message = sprintf(
            "Router Replacement for '%s' not found.",
            $key,
        );

        parent::__construct($message);
    }



    public function getKey(): string
    {
        return $this->key;
    }
}
