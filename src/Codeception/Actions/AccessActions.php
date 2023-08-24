<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Access\AccessInterface;
use PHPUnit\Framework\Assert;

trait AccessActions
{
    /**
     * @template T of object
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    abstract public function grabFromContainer(string $class): object;



    /**
     * Grab the Access from the Container.
     */
    public function grabAccess(): AccessInterface
    {
        return $this->grabFromContainer(AccessInterface::class);
    }

    /**
     * Allow a user to do a particular activity in Access.
     */
    public function allowAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->allow($user, $activityName);
    }

    /**
     * Deny a user to do a particular activity in Access.
     */
    public function denyAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->deny($user, $activityName);
    }

    public function removeFromAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->remove($user, $activityName);
    }

    /**
     * Check if a user is allowed to do a particular activity in Access.
     */
    public function seeIsAllowed(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        Assert::assertTrue(
            $access->isAllowed($user, $activityName)
        );
    }

    /**
     * Check if a user is NOT allowed to do a particular activity in Access.
     */
    public function seeIsNotAllowed(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        Assert::assertFalse(
            $access->isAllowed($user, $activityName)
        );
    }
}
