<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToNull;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Cast\ToNull
 */
class ToNullCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToNull();

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            null
        );
    }

    protected function provider(): array
    {
        return [
            [
                "input" => [1,2,3],
            ],

            [
                "input" => true,
            ],

            [
                "input" => 123.456,
            ],

            [
                "input" => 123,
            ],

            [
                "input" => null,
            ],

            [
                "input" => new stdClass(),
            ],

            [
                "input" => "Sid Roberts",
            ],
        ];
    }
}
