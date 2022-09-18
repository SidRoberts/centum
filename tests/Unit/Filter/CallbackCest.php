<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Callback;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

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

        /** @var string */
        $expected = $example["expected"];

        /** @var string */
        $value = $example["value"];

        $I->assertEquals(
            $expected,
            $filter->filter($value)
        );
    }

    protected function provider(): array
    {
        return [
            [
                "value"    => "Sid Roberts",
                "expected" => "sid-roberts",
            ],

            [
                "value"    => "SID ROBERTS  ",
                "expected" => "sid-roberts--",
            ],
        ];
    }
}
