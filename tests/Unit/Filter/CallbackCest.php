<?php

namespace Tests\Unit\Filter;

use Centum\Filter\Callback;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Callback
 */
final class CallbackCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(Callback::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Callback(
            function (mixed $value): string {
                if (!is_string($value)) {
                    throw new InvalidArgumentException("Value is not a string.");
                }

                return str_replace(" ", "-", mb_strtolower($value));
            }
        );

        $I->expectFilterOutput(
            $filter,
            $example["input"],
            $example["output"]
        );
    }

    /**
     * @return array<array{input: string, output: string}>
     */
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
