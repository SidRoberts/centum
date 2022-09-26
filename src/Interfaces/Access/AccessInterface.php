<?php

namespace Centum\Interfaces\Access;

interface AccessInterface
{
    public function allow(string $user, string $activityName): void;

    public function deny(string $user, string $activityName): void;

    public function remove(string $user, string $activityName): void;



    public function isAllowed(string $user, string $activityName): bool;
}
