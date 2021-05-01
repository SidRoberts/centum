<?php

namespace Tests\Unit\Http\Session;

use Centum\Http\Session\ArrayHandler;
use Tests\UnitTester;

class ArrayHandlerCest
{
    public function testStart(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $I->assertTrue(
            $handler->start()
        );
    }

    public function testIsActive(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $I->assertTrue(
            $handler->isActive()
        );
    }

    public function testGetAndSet(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $name = "Sid Roberts";

        $handler->set("name", $name);

        $I->assertEquals(
            $name,
            $handler->get("name")
        );
    }

    public function testHas(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $I->assertFalse(
            $handler->has("name")
        );

        $handler->set("name", "Sid Roberts");

        $I->assertTrue(
            $handler->has("name")
        );
    }

    public function testAll(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $I->assertEquals(
            [],
            $handler->all()
        );

        $handler->set("name", "Sid Roberts");
        $handler->set("city", "Busan");

        $I->assertEquals(
            [
                "name" => "Sid Roberts",
                "city" => "Busan",
            ],
            $handler->all()
        );
    }

    public function testRemove(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $handler->set("name", "Sid Roberts");

        $handler->remove("name");

        $I->assertFalse(
            $handler->has("name")
        );
    }

    public function testClear(UnitTester $I)
    {
        $handler = new ArrayHandler();

        $handler->set("name", "Sid Roberts");
        $handler->set("city", "Busan");

        $handler->clear();

        $I->assertEmpty(
            $handler->all()
        );
    }
}
