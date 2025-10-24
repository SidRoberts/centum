<?php

namespace Tests\Unit\Container;

use Centum\Container\Parameter;
use Centum\Interfaces\Container\ParameterInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Parameter
 */
final class ParameterCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $parameter = $I->mock(Parameter::class);

        $I->assertInstanceOf(ParameterInterface::class, $parameter);
    }



    public function testHasType(UnitTester $I): void
    {
        $parameter = new Parameter("string");

        $I->assertTrue(
            $parameter->hasType()
        );

        $parameter = new Parameter();

        $I->assertFalse(
            $parameter->hasType()
        );
    }

    public function testGetType(UnitTester $I): void
    {
        $type = "string";

        $parameter = new Parameter($type);

        $I->assertEquals(
            $type,
            $parameter->getType()
        );

        $parameter = new Parameter();

        $I->assertNull(
            $parameter->getType()
        );
    }



    public function testIsObject(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testHasName(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testGetName(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testIsOptional(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testAllowsNull(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testHasDefaultValue(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testGetDefaultValue(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testHasDeclaringClass(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testGetDeclaringClass(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }
}
