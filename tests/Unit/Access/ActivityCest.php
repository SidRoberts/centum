<?php

namespace Tests\Unit;

use Centum\Access\Access;
use Centum\Access\Activity;
use Tests\Support\UnitTester;

class ActivityCest
{
    public function testNoDefault(UnitTester $I): void
    {
        $activity = new Activity("component");

        $I->assertTrue(
            $activity->isAllowed("role")
        );

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );
    }

    public function testNoDefaultRemove(UnitTester $I): void
    {
        $activity = new Activity("component");

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );

        $activity->remove("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );
    }

    public function testDefaultAllow(UnitTester $I): void
    {
        $activity = new Activity(
            "component",
            Access::ALLOW
        );

        $I->assertTrue(
            $activity->isAllowed("role")
        );

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );
    }

    public function testDefaultAllowRemove(UnitTester $I): void
    {
        $activity = new Activity(
            "component",
            Access::ALLOW
        );

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );

        $activity->remove("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );
    }

    public function testDefaultDeny(UnitTester $I): void
    {
        $activity = new Activity(
            "component",
            Access::DENY
        );

        $I->assertFalse(
            $activity->isAllowed("role")
        );

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );
    }

    public function testDefaultDenyRemove(UnitTester $I): void
    {
        $activity = new Activity(
            "component",
            Access::DENY
        );

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );

        $activity->remove("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );
    }
}
