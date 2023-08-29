<?php

namespace Tests\Unit\Access;

use Centum\Access\Access;
use Centum\Access\Exception\AccessDeniedException;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Access\Access
 */
class AccessCest
{
    public function testDefault(UnitTester $I): void
    {
        $access = new Access();

        $I->assertTrue(
            $access->getDefault()
        );
    }



    #[DataProvider("providerInitialState")]
    public function testInitialState(UnitTester $I, Example $example): void
    {
        /** @var Access */
        $access = $example["access"];

        $I->assertEquals(
            $example["expected"],
            $access->getDefault()
        );

        $I->assertEquals(
            $example["expected"],
            $access->isAllowed("role", "component")
        );
    }

    protected function providerInitialState(): array
    {
        return [
            [
                "access"   => new Access(),
                "expected" => true,
            ],

            [
                "access"   => new Access(Access::ALLOW),
                "expected" => true,
            ],

            [
                "access"   => new Access(Access::DENY),
                "expected" => false,
            ],
        ];
    }



    #[DataProvider("providerAllow")]
    public function testAllow(UnitTester $I, Example $example): void
    {
        /** @var Access */
        $access = $example["access"];

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );
    }

    protected function providerAllow(): array
    {
        return [
            [
                "access" => new Access(),
            ],

            [
                "access" => new Access(Access::ALLOW),
            ],

            [
                "access" => new Access(Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerDeny")]
    public function testDeny(UnitTester $I, Example $example): void
    {
        /** @var Access */
        $access = $example["access"];

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );
    }

    protected function providerDeny(): array
    {
        return [
            [
                "access" => new Access(),
            ],

            [
                "access" => new Access(Access::ALLOW),
            ],

            [
                "access" => new Access(Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerAllowDeny")]
    public function testAllowDeny(UnitTester $I, Example $example): void
    {
        /** @var Access */
        $access = $example["access"];

        $access->allow("role", "component");

        $I->assertTrue(
            $access->isAllowed("role", "component")
        );

        $access->deny("role", "component");

        $I->assertFalse(
            $access->isAllowed("role", "component")
        );
    }

    protected function providerAllowDeny(): array
    {
        return [
            [
                "access" => new Access(),
            ],

            [
                "access" => new Access(Access::ALLOW),
            ],

            [
                "access" => new Access(Access::DENY),
            ],
        ];
    }



    #[DataProvider("providerRemove")]
    public function testRemove(UnitTester $I, Example $example): void
    {
        /** @var Access */
        $access = $example["access"];

        $access->allow("role", "component");

        $access->remove("role", "component");

        $I->assertEquals(
            $example["expected"],
            $access->isAllowed("role", "component")
        );

        $access->deny("role", "component");

        $access->remove("role", "component");

        $I->assertEquals(
            $example["expected"],
            $access->isAllowed("role", "component")
        );
    }

    protected function providerRemove(): array
    {
        return [
            [
                "access"   => new Access(),
                "expected" => true,
            ],

            [
                "access"   => new Access(Access::ALLOW),
                "expected" => true,
            ],

            [
                "access"   => new Access(Access::DENY),
                "expected" => false,
            ],
        ];
    }



    public function testVerify(UnitTester $I): void
    {
        $user = "sidroberts";

        $allowedActivity    = "add-user";
        $disallowedActivity = "purge-database";

        $access = new Access();

        $access->allow($user, $allowedActivity);
        $access->deny($user, $disallowedActivity);



        $access->verify($user, $allowedActivity);

        $I->expectThrowable(
            AccessDeniedException::class,
            function () use ($access, $user, $disallowedActivity): void {
                $access->verify($user, $disallowedActivity);
            }
        );
    }
}
