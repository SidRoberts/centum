<?php

namespace Tests\Container;

class DifferentTypes
{
    public function resolvable(string $name = "Sid")
    {
        return $name;
    }

    public function resolvable2(string $name = null)
    {
        return $name;
    }

    public function resolvable3(?string $name)
    {
        return $name;
    }

    public function unresolvable(string $name)
    {
        return $name;
    }
}
