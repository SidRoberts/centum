<?php

namespace Centum\Console\Exception;

class CommandNotFoundException extends \Exception
{
    protected readonly string $name;



    public function __construct(string $name)
    {
        $this->name = $name;
    }



    public function getName(): string
    {
        return $this->name;
    }
}
