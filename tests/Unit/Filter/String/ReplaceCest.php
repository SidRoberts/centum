<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Replace;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class ReplaceCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Replace(
            [
                "2",
                "Sid",
                " ",
            ],
            [
                "two",
                "시드",
                "<SPACE>",
            ]
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
                "value"    => "123",
                "expected" => "1two3",
            ],

            [
                "value"    => "Sid Roberts",
                "expected" => "시드<SPACE>Roberts",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Replace(
            [
                "i",
                "o",
                " ",
            ],
            [
                "1",
                "0",
                "<SPACE>",
            ]
        );

        /** @var mixed */
        $value = $example["value"];

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $value): void {
                $filter->filter($value);
            }
        );
    }

    protected function providerException(): array
    {
        return [
            [
                "value" => true,
            ],

            [
                "value" => 0,
            ],

            [
                "value" => 123.456,
            ],

            [
                "value" => ["1", 2, "three"],
            ],

            [
                "value" => (object) ["1", 2, "three"],
            ],
        ];
    }
}
