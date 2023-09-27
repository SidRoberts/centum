<?php

namespace Tests\Unit\Http\Session;

use Centum\Http\Session\GlobalSession;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Session\GlobalSession
 */
final class GlobalSessionCest
{
    public function _before(): void
    {
        $_SESSION = [];
    }

    public function _after(): void
    {
        $_SESSION = [];
    }



    protected function getSession(): GlobalSession
    {
        /*
         * `start()` and `isActive()` rely on native PHP functions that can't be
         * reliably tested so they have to be replaced in the testing process.
         */
        return new class() extends GlobalSession {
            protected bool $startState = false;

            public function start(): bool
            {
                if ($this->startState) {
                    return false;
                }

                $this->startState = true;

                return true;
            }

            public function isActive(): bool
            {
                return $this->startState;
            }
        };
    }



    public function testStartIfNotActive(UnitTester $I): void
    {
        $session = $this->getSession();

        $I->assertFalse(
            $session->isActive()
        );

        $I->assertTrue(
            $session->startIfNotActive()
        );

        $I->assertTrue(
            $session->isActive()
        );
    }

    public function testStartIfNotActiveAlreadyActive(UnitTester $I): void
    {
        $session = $this->getSession();

        $I->assertFalse(
            $session->isActive()
        );

        $session->start();

        $I->assertTrue(
            $session->startIfNotActive()
        );

        $I->assertTrue(
            $session->isActive()
        );
    }



    public function testGetAndSet(UnitTester $I): void
    {
        $session = $this->getSession();

        $name = "Sid Roberts";

        $session->set("name", $name);

        $I->assertEquals(
            $name,
            $session->get("name")
        );

        $I->assertEquals(
            $name,
            $_SESSION["name"]
        );
    }

    public function testHas(UnitTester $I): void
    {
        $session = $this->getSession();

        $I->assertFalse(
            $session->has("name")
        );

        /** @var array $_SESSION */
        $I->assertArrayNotHasKey(
            "name",
            $_SESSION
        );

        $session->set("name", "Sid Roberts");

        $I->assertTrue(
            $session->has("name")
        );

        $I->assertArrayHasKey(
            "name",
            $_SESSION
        );

        $session->set("nullValue", null);

        $I->assertTrue(
            $session->has("nullValue")
        );

        $I->assertArrayHasKey(
            "nullValue",
            $_SESSION
        );
    }

    public function testAll(UnitTester $I): void
    {
        $session = $this->getSession();

        $I->assertEquals(
            [],
            $session->all()
        );

        $I->assertEquals(
            [],
            $_SESSION
        );

        $session->set("name", "Sid Roberts");
        $session->set("city", "Busan");

        $I->assertEquals(
            [
                "name" => "Sid Roberts",
                "city" => "Busan",
            ],
            $session->all()
        );

        $I->assertEquals(
            [
                "name" => "Sid Roberts",
                "city" => "Busan",
            ],
            $_SESSION
        );
    }

    public function testRemove(UnitTester $I): void
    {
        $session = $this->getSession();

        $session->set("name", "Sid Roberts");

        $session->remove("name");

        $I->assertFalse(
            $session->has("name")
        );

        /** @var array $_SESSION */
        $I->assertArrayNotHasKey(
            "name",
            $_SESSION
        );
    }

    public function testClear(UnitTester $I): void
    {
        $session = $this->getSession();

        $session->set("name", "Sid Roberts");
        $session->set("city", "Busan");

        $session->clear();

        $I->assertEmpty(
            $session->all()
        );

        $I->assertEmpty(
            $_SESSION
        );
    }
}
