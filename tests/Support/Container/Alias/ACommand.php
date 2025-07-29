<?php

namespace Tests\Support\Container\Alias;

final class ACommand implements CommandInterface
{
    public function execute(): string
    {
        return self::class;
    }
}
