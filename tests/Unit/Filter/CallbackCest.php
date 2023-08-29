<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Callback;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Callback
 */
class CallbackCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Callback(
            function (mixed $value): string {
                if (!is_string($value)) {
                    throw new InvalidArgumentException("Value is not a string.");
                }

                return str_replace(" ", "-", strtolower($value));
            }
        );

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    protected function provider(): array
    {
        return [
            [
                "input"  => "Sid Roberts",
                "output" => "sid-roberts",
            ],

            [
                "input"  => "SID ROBERTS  ",
                "output" => "sid-roberts--",
            ],
        ];
    }
}
