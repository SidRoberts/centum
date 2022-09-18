<?php

namespace Tests\Unit\Filter\Cast;

use Centum\Filter\Cast\ToNull;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use stdClass;
use Tests\Support\UnitTester;

class ToNullCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new ToNull();

        /** @var mixed */
        $value = $example["value"];

        $I->assertNull(
            $filter->filter($value)
        );
    }

    protected function provider(): array
    {
        return [
            [
                "value" => [1,2,3],
            ],

            [
                "value" => true,
            ],

            [
                "value" => 123.456,
            ],

            [
                "value" => 123,
            ],

            [
                "value" => null,
            ],

            [
                "value" => new stdClass(),
            ],

            [
                "value" => "Sid Roberts",
            ],
        ];
    }
}
