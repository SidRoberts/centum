<?php

namespace Tests\Unit\Console;

use Centum\Console\Parameters;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class ParametersCest
{
    public function getParameters(): Parameters
    {
        $argv = [
            "cli.php",
            "boring",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        return new Parameters($argv);
    }



    #[DataProvider("providerHas")]
    public function testHas(UnitTester $I, Example $example): void
    {
        /** @var bool */
        $expected = $example["expected"];

        $parameters = $this->getParameters();

        /** @var string */
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
                "expected" => false,
                "key"      => "cli.php",
            ],

            [
                "expected" => false,
                "key"      => "boring",
            ],

            [
                "expected" => true,
                "key"      => "i",
            ],

            [
                "expected" => false,
                "key"      => "123",
            ],

            [
                "expected" => true,
                "key"      => "verbose",
            ],

            [
                "expected" => true,
                "key"      => "dry-run",
            ],
        ];
    }



    #[DataProvider("providerGet")]
    public function testGet(UnitTester $I, Example $example): void
    {
        /** @var bool */
        $expected = $example["expected"];

        $parameters = $this->getParameters();

        /** @var string */
        $key = $example["key"];

        $I->assertEquals(
            $expected,
            $parameters->get($key)
        );
    }

    protected function providerGet(): array
    {
        return [
            [
                "key"      => "i",
                "expected" => "123",
            ],

            [
                "key"      => "verbose",
                "expected" => true,
            ],

            [
                "key"      => "dry-run",
                "expected" => true,
            ],
        ];
    }



    public function testSet(UnitTester $I): void
    {
        $parameters = $this->getParameters();

        $parameters->set("i", "456");

        $I->assertEquals(
            "456",
            $parameters->get("i")
        );
    }



    public function testToArray(UnitTester $I): void
    {
        $parameters = $this->getParameters();

        $I->assertEquals(
            [
                "i"       => 123,
                "verbose" => true,
                "dry-run" => true,
            ],
            $parameters->toArray()
        );
    }
}
