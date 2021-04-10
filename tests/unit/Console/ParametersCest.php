<?php

namespace Tests\Console;

use Centum\Console\Parameters;
use Tests\UnitTester;

class ParametersCest
{
    public function toArray(UnitTester $I): void
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
