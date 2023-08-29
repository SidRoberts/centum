<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\SlugToCamelCase;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\SlugToCamelCase
 */
class SlugToCamelCaseCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new SlugToCamelCase();

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
                "input"  => "this-is-a-sentence",
                "output" => "thisIsASentence",
            ],
        ];
    }



    #[DataProvider("providerExceptionNotAString")]
    public function testExceptionNotAString(UnitTester $I, Example $example): void
    {
        $filter = new SlugToCamelCase();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

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
