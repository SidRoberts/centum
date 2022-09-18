<?php

namespace Tests\Unit\Console;

use Centum\Console\Parameters;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class ParametersCest
{
    #[DataProvider("providerHas")]
    public function testHas(UnitTester $I, Example $example): void
    {
        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        $parameters = new Parameters($argv);

        /** @var bool */
        $expected = $example["expected"];

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
                "key"      => "filter:double",
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
        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        $parameters = new Parameters($argv);

        /** @var bool */
        $expected = $example["expected"];

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
        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        $parameters = new Parameters($argv);

        $parameters->set("i", "456");

        $I->assertEquals(
            "456",
            $parameters->get("i")
        );
    }



    public function testToArray(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "filter:double",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        $parameters = new Parameters($argv);

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
