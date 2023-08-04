<?php

namespace Tests\Unit;

use Centum\Access\Access;
use Centum\Access\Activity;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class ActivityCest
{
    public function testGetName(UnitTester $I): void
    {
        $name = "component";

        $activity = new Activity($name);

        $I->assertEquals(
            $name,
            $activity->getName()
        );
    }



    #[DataProvider("providerInitialState")]
    public function testInitialState(UnitTester $I, Example $example): void
    {
        /** @var Activity */
        $activity = $example["activity"];

        $I->assertEquals(
            $example["expected"],
            $activity->isAllowed("role")
        );
    }

    protected function providerInitialState(): array
    {
        return [
            [
                "activity" => new Activity("component"),
                "expected" => true,
            ],

            [
                "activity" => new Activity("component", Access::ALLOW),
                "expected" => true,
            ],

            [
                "activity" => new Activity("component", Access::DENY),
                "expected" => false,
            ],
        ];
    }



    #[DataProvider("providerAllow")]
    public function testAllow(UnitTester $I, Example $example): void
    {
        /** @var Activity */
        $activity = $example["activity"];

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );
    }

    protected function providerAllow(): array
    {
        return [
            [
                "activity" => new Activity("component"),
            ],

            [
                "activity" => new Activity("component", Access::ALLOW),
            ],

            [
                "activity" => new Activity("component", Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerDeny")]
    public function testDeny(UnitTester $I, Example $example): void
    {
        /** @var Activity */
        $activity = $example["activity"];

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );
    }

    protected function providerDeny(): array
    {
        return [
            [
                "activity" => new Activity("component"),
            ],

            [
                "activity" => new Activity("component", Access::ALLOW),
            ],

            [
                "activity" => new Activity("component", Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerAllowDeny")]
    public function testAllowDeny(UnitTester $I, Example $example): void
    {
        /** @var Activity */
        $activity = $example["activity"];

        $activity->allow("role");

        $I->assertTrue(
            $activity->isAllowed("role")
        );

        $activity->deny("role");

        $I->assertFalse(
            $activity->isAllowed("role")
        );
    }

    protected function providerAllowDeny(): array
    {
        return [
            [
                "activity" => new Activity("component"),
            ],

            [
                "activity" => new Activity("component", Access::ALLOW),
            ],

            [
                "activity" => new Activity("component", Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerRemove")]
    public function testRemove(UnitTester $I, Example $example): void
    {
        /** @var Activity */
        $activity = $example["activity"];

        $activity->allow("role");

        $activity->remove("role");

        $I->assertEquals(
            $example["expected"],
            $activity->isAllowed("role")
        );

        $activity->deny("role");

        $activity->remove("role");

        $I->assertEquals(
            $example["expected"],
            $activity->isAllowed("role")
        );
    }

    protected function providerRemove(): array
    {
        return [
            [
                "activity" => new Activity("component"),
                "expected" => true,
            ],

            [
                "activity" => new Activity("component", Access::ALLOW),
                "expected" => true,
            ],

            [
                "activity" => new Activity("component", Access::DENY),
                "expected" => false,
            ],
        ];
    }
}
