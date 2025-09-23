<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\CamelCaseToSlug;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\CamelCaseToSlug
 */
final class CamelCaseToSlugCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new CamelCaseToSlug();

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
                "input"  => "ThisIsASentence",
                "output" => "this-is-a-sentence",
            ],

            [
                "input"  => "thisIsASentence",
                "output" => "this-is-a-sentence",
            ],
        ];
    }



    #[DataProvider("providerExceptionNotAString")]
    public function testExceptionNotAString(UnitTester $I, Example $example): void
    {
        $filter = new CamelCaseToSlug();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: mixed}>
     */
    protected function providerExceptionNotAString(): array
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
