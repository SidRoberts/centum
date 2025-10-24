<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Replace;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\Replace
 */
final class ReplaceCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(Replace::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



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
                "input"  => "123",
                "output" => "1two3",
            ],

            [
                "input"  => "Sid Roberts",
                "output" => "시드<SPACE>Roberts",
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

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: mixed}>
     */
    protected function providerException(): array
    {
        return [
            [
                "input" => true,
            ],

            [
                "input" => 0,
            ],

            [
                "input" => 123.456,
            ],

            [
                "input" => ["1", 2, "three"],
            ],

            [
                "input" => (object) ["1", 2, "three"],
            ],
        ];
    }
}
