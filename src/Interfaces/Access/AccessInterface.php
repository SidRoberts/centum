<?php

namespace Centum\Interfaces\Access;

interface AccessInterface
{
    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function allow(string $user, string $activityName): void;

    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function deny(string $user, string $activityName): void;

    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function remove(string $user, string $activityName): void;



    /**
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function isAllowed(string $user, string $activityName): bool;
}
