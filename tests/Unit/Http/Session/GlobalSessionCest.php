<?php

namespace Tests\Unit\Http\Session;

use Centum\Http\Session\GlobalSession;
use Tests\Support\UnitTester;

class GlobalSessionCest
{
    public function _before(UnitTester $I): void
    {
        $_SESSION = [];
    }

    public function _after(UnitTester $I): void
    {
        $_SESSION = [];
    }



    protected function getSession(): GlobalSession
    {
        /*
         * `start()` and `isActive()` rely on native PHP functions that can't be
         * reliably tested so they have to be replaced in the testing process.
         */
        return new class extends GlobalSession {
            public function start(): bool
            {
                return true;
            }

            public function isActive(): bool
            {
                return true;
            }
        };
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
        /** @var array $_SESSION */

        $session = $this->getSession();

        $I->assertFalse(
            $session->has("name")
        );

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
        /** @var array $_SESSION */

        $session = $this->getSession();

        $session->set("name", "Sid Roberts");

        $session->remove("name");

        $I->assertFalse(
            $session->has("name")
        );

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
