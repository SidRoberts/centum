<?php

namespace Tests\Support\Container\Alias;

class ACommand implements CommandInterface
{
    public function execute(): string
    {
        return self::class;
    }
}
