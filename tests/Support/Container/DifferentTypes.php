<?php

namespace Tests\Support\Container;

final class DifferentTypes
{
    public function resolvable(string $name = "Sid"): string
    {
        return $name;
    }

    public function resolvable2(?string $name = null): ?string
    {
        return $name;
    }

    public function resolvable3(?string $name): ?string
    {
        return $name;
    }

    public function resolvable4(mixed $name = "Sid"): mixed
    {
        return $name;
    }

    public function resolvable5(mixed $name = null): mixed
    {
        return $name;
    }

    /**
     * @param mixed $name
     */
    public function resolvable6($name = "Sid"): mixed
    {
        return $name;
    }

    public function unresolvable(string $name): string
    {
        return $name;
    }
}
