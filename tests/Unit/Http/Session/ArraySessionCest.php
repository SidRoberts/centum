<?php

namespace Tests\Unit\Http\Session;

use Centum\Http\Session\ArraySession;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Session\ArraySession
 */
class ArraySessionCest
{
    public function testStart(UnitTester $I): void
    {
        $session = new ArraySession();

        $I->assertTrue(
            $session->start()
        );
    }

    public function testIsActive(UnitTester $I): void
    {
        $session = new ArraySession();

        $I->assertTrue(
            $session->isActive()
        );
    }

    public function testGetAndSet(UnitTester $I): void
    {
        $session = new ArraySession();

        $name = "Sid Roberts";

        $session->set("name", $name);

        $I->assertEquals(
            $name,
            $session->get("name")
        );
    }

    public function testHas(UnitTester $I): void
    {
        $session = new ArraySession();

        $I->assertFalse(
            $session->has("name")
        );

        $session->set("name", "Sid Roberts");

        $I->assertTrue(
            $session->has("name")
        );
    }

    public function testAll(UnitTester $I): void
    {
        $session = new ArraySession();

        $I->assertEquals(
            [],
            $session->all()
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
    }

    public function testRemove(UnitTester $I): void
    {
        $session = new ArraySession();

        $session->set("name", "Sid Roberts");

        $session->remove("name");

        $I->assertFalse(
            $session->has("name")
        );
    }

    public function testClear(UnitTester $I): void
    {
        $session = new ArraySession();

        $session->set("name", "Sid Roberts");
        $session->set("city", "Busan");

        $session->clear();

        $I->assertEmpty(
            $session->all()
        );
    }
}
