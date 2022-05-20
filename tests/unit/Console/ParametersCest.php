<?php

namespace Tests\Unit\Console;

use Centum\Console\Parameters;
use Tests\UnitTester;

class ParametersCest
{
    public function testHas(UnitTester $I): void
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

        $I->assertFalse(
            $parameters->has("cli.php")
        );

        $I->assertFalse(
            $parameters->has("filter:double")
        );

        $I->assertTrue(
            $parameters->has("i")
        );

        $I->assertFalse(
            $parameters->has("123")
        );

        $I->assertTrue(
            $parameters->has("verbose")
        );

        $I->assertTrue(
            $parameters->has("dry-run")
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
