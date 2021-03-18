<?php

namespace Tests\Container\Alias;

class ACommand implements CommandInterface
{
    public function execute() : string
    {
        return self::class;
    }
}
