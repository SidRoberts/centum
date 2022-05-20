<?php

namespace Tests\Unit\Access;

use Centum\Access\Access;
use Tests\UnitTester;

class AccessCest
{
    public function testNoDefault(UnitTester $I): void
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

    public function testNoDefaultRemove(UnitTester $I): void
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

    public function testDefaultAllow(UnitTester $I): void
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

    public function testDefaultAllowRemove(UnitTester $I): void
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

    public function testDefaultDeny(UnitTester $I): void
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

    public function testDefaultDenyRemove(UnitTester $I): void
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
