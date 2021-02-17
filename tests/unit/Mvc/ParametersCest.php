<?php

namespace Centum\Tests\Mvc;

use Centum\Mvc\Parameters;
use Centum\Tests\UnitTester;
use Codeception\Example;

class ParametersCest
{
    public function test(UnitTester $I)
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

    public function testDefaultValue(UnitTester $I)
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
}
