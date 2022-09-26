<?php

namespace Centum\Interfaces\Access;

interface ActivityInterface
{
    public function allow(string $user): void;

    public function deny(string $user): void;

    public function remove(string $user): void;



    public function isAllowed(string $user): bool;
}
