<?php

namespace Tests\Unit\Http\Session;

use Centum\Http\Session\GlobalSession;
use Tests\Support\UnitTester;

class GlobalSessionCest
{
    protected GlobalSession $session;



    public function _before(UnitTester $I): void
    {
        $_SESSION = [];

        /*
         * `start()` and `isActive()` rely on native PHP functions that can't be
         * reliably tested so they have to be replaced in the testing process.
         */
        $this->session = new class extends GlobalSession {
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

    public function _after(UnitTester $I): void
    {
        $_SESSION = [];
    }



    public function testGetAndSet(UnitTester $I): void
    {
        $name = "Sid Roberts";

        $this->session->set("name", $name);

        $I->assertEquals(
            $name,
            $this->session->get("name")
        );

        $I->assertEquals(
            $name,
            $_SESSION["name"]
        );
    }

    public function testHas(UnitTester $I): void
    {
        /** @var array $_SESSION */

        $I->assertFalse(
            $this->session->has("name")
        );

        $I->assertArrayNotHasKey(
            "name",
            $_SESSION
        );

        $this->session->set("name", "Sid Roberts");

        $I->assertTrue(
            $this->session->has("name")
        );

        $I->assertArrayHasKey(
            "name",
            $_SESSION
        );
    }

    public function testAll(UnitTester $I): void
    {
        $I->assertEquals(
            [],
            $this->session->all()
        );

        $I->assertEquals(
            [],
            $_SESSION
        );

        $this->session->set("name", "Sid Roberts");
        $this->session->set("city", "Busan");

        $I->assertEquals(
            [
                "name" => "Sid Roberts",
                "city" => "Busan",
            ],
            $this->session->all()
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

        $this->session->set("name", "Sid Roberts");

        $this->session->remove("name");

        $I->assertFalse(
            $this->session->has("name")
        );

        $I->assertArrayNotHasKey(
            "name",
            $_SESSION
        );
    }

    public function testClear(UnitTester $I): void
    {
        $this->session->set("name", "Sid Roberts");
        $this->session->set("city", "Busan");

        $this->session->clear();

        $I->assertEmpty(
            $this->session->all()
        );

        $I->assertEmpty(
            $_SESSION
        );
    }
}
