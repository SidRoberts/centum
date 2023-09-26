<?php

namespace Tests\Unit\Router;

use Centum\Router\Parameters;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Router\Parameters
 */
final class ParametersCest
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



    #[DataProvider("providerHas")]
    public function testHas(UnitTester $I, Example $example): void
    {
        $parameters = new Parameters(
            [
                "a" => "",
                "b" => false,
                "c" => 0,
                "d" => null,
            ]
        );

        /** @var bool */
        $expected = $example["expected"];

        /** @var non-empty-string */
        $key = $example["key"];

        $I->assertEquals(
            $expected,
            $parameters->has($key)
        );
    }

    protected function providerHas(): array
    {
        return [
            [
                "key"      => "a",
                "expected" => true,
            ],

            [
                "key"      => "b",
                "expected" => true,
            ],

            [
                "key"      => "c",
                "expected" => true,
            ],

            [
                "key"      => "d",
                "expected" => true,
            ],

            [
                "key"      => "e",
                "expected" => false,
            ],
        ];
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
