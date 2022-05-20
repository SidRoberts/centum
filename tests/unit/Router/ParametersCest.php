<?php

namespace Tests\Unit\Router;

use Centum\Router\Parameters;
use Tests\UnitTester;

class ParametersCest
{
    public function test(UnitTester $I): void
    {
        $parameters = new Parameters(
            [
                "a" => 123,
                "b" => 456,
                "c" => 789,
            ]
        );

        $I->assertEquals(
            123,
            $parameters->get("a")
        );

        $I->assertEquals(
            456,
            $parameters->get("b")
        );

        $I->assertEquals(
            789,
            $parameters->get("c")
        );
    }

    public function testDefaultValue(UnitTester $I): void
    {
        $parameters = new Parameters(
            []
        );

        $I->assertNull(
            $parameters->get("doesnt-exist")
        );

        $I->assertEquals(
            "default",
            $parameters->get("doesnt-exist", "default")
        );
    }

    public function testHas(UnitTester $I): void
    {
        $parameters = new Parameters(
            [
                "a" => "hello",
                "b" => false,
                "c" => 0,
                "d" => null,
            ]
        );

        $I->assertTrue(
            $parameters->has("a")
        );

        $I->assertTrue(
            $parameters->has("b")
        );

        $I->assertTrue(
            $parameters->has("c")
        );

        $I->assertTrue(
            $parameters->has("d")
        );

        $I->assertFalse(
            $parameters->has("e")
        );
    }

    public function testToArray(UnitTester $I): void
    {
        $data = [
            "a" => 123,
            "b" => 456,
            "c" => 789,
        ];

        $parameters = new Parameters($data);

        $I->assertEquals(
            $data,
            $parameters->toArray()
        );
    }
}
