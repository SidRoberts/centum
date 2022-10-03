<?php

namespace Tests\Codeception;

use Centum\Access\Access;
use Centum\Interfaces\Access\AccessInterface;
use Tests\Support\CodeceptionTester;

class AccessActionsCest
{
    public function testGrabAccess(CodeceptionTester $I): void
    {
        $accessFromContainer = $I->grabFromContainer(AccessInterface::class);

        $access = $I->grabAccess();

        $I->assertSame(
            $accessFromContainer,
            $access
        );
    }

    public function testAllowAccess(CodeceptionTester $I): void
    {
        $access = new Access(Access::DENY);

        $I->addToContainer(AccessInterface::class, $access);

        $I->allowAccess("moderators", "delete-user");

        $I->assertTrue(
            $access->isAllowed("moderators", "delete-user")
        );
    }

    public function testDenyAccess(CodeceptionTester $I): void
    {
        $access = new Access(Access::ALLOW);

        $I->addToContainer(AccessInterface::class, $access);

        $I->denyAccess("moderators", "delete-user");

        $I->assertFalse(
            $access->isAllowed("moderators", "delete-user")
        );
    }

    public function testRemoveFromAccess(CodeceptionTester $I): void
    {
        $access = new Access(Access::ALLOW);

        $access->deny("moderators", "delete-user");

        $I->addToContainer(AccessInterface::class, $access);

        $I->removeFromAccess("moderators", "delete-user");

        $I->assertTrue(
            $access->isAllowed("moderators", "delete-user")
        );
    }

    public function testSeeIsAllowed(CodeceptionTester $I): void
    {
        $access = new Access(Access::ALLOW);

        $I->addToContainer(AccessInterface::class, $access);

        $I->seeIsAllowed("moderators", "delete-user");
    }

    public function testSeeIsNotAllowed(CodeceptionTester $I): void
    {
        $access = new Access(Access::DENY);

        $I->addToContainer(AccessInterface::class, $access);

        $I->seeIsNotAllowed("guests", "delete-user");
    }
}
