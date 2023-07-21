<?php

namespace Centum\Console\Exception;

class CommandNotFoundException extends \Exception
{
    public function __construct(
        protected readonly string $name
    ) {
    }



    public function getName(): string
    {
        return $this->name;
    }
}
