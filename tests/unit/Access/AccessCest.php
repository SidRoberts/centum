<?php

namespace Centum\Tests\Access;

use Centum\Access\Access;
use Centum\Tests\UnitTester;

class AccessCest
{
    public function noDefault(UnitTester $I)
    {
        $access = new Access();

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );
    }

    public function noDefaultRemove(UnitTester $I)
    {
        $access = new Access();

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );

        $access->remove("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );
    }

    public function defaultAllow(UnitTester $I)
    {
        $access = new Access(
            Access::ALLOW
        );

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );
    }

    public function defaultAllowRemove(UnitTester $I)
    {
        $access = new Access(
            Access::ALLOW
        );

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );

        $access->remove("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );
    }

    public function defaultDeny(UnitTester $I)
    {
        $access = new Access(
            Access::DENY
        );

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );
    }

    public function defaultDenyRemove(UnitTester $I)
    {
        $access = new Access(
            Access::DENY
        );

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );

        $access->remove("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );
    }
}
