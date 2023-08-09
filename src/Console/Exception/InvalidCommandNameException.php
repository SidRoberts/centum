<?php

namespace Centum\Console\Exception;

class InvalidCommandNameException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
        $message = sprintf(
            "Command name (%s) is not valid.",
            $name
        );

        parent::__construct($message);
    }



    public function getName(): string
    {
        return $this->name;
    }
}
