<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Access\AccessInterface;
use PHPUnit\Framework\Assert;

/**
 * Access Actions
 */
trait AccessActions
{
    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
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
     *
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function allowAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->allow($user, $activityName);
    }

    /**
     * Deny a user to do a particular activity in Access.
     *
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function denyAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->deny($user, $activityName);
    }

    /**
     * Remove a rule from Access.
     *
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function removeFromAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->remove($user, $activityName);
    }

    /**
     * Check if a user is allowed to do a particular activity in Access.
     *
     * @param non-empty-string $user
     * @param non-empty-string $activityName
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
     *
     * @param non-empty-string $user
     * @param non-empty-string $activityName
     */
    public function seeIsNotAllowed(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        Assert::assertFalse(
            $access->isAllowed($user, $activityName)
        );
    }
}
