<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToNull;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\Cast\ToNull
 */
final class ToNullCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(ToNull::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



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

    /**
     * @return array<array{input: mixed}>
     */
    protected function provider(): array
    {
        return [
            [
                "input" => [1, 2, 3],
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
