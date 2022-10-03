<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Container\ContainerInterface;
use PHPUnit\Framework\Assert;

trait AccessActions
{
    abstract public function grabContainer(): ContainerInterface;



    public function grabAccess(): AccessInterface
    {
        $container = $this->grabContainer();

        return $container->get(AccessInterface::class);
    }

    public function allowAccess(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        $access->allow($user, $activityName);
    }

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

    public function seeIsAllowed(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        Assert::assertTrue(
            $access->isAllowed($user, $activityName)
        );
    }

    public function seeIsNotAllowed(string $user, string $activityName): void
    {
        $access = $this->grabAccess();

        Assert::assertFalse(
            $access->isAllowed($user, $activityName)
        );
    }
}
