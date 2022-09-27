<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Base64Encode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class Base64EncodeCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Base64Encode();

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
                "value"    => "Hello",
                "expected" => "SGVsbG8=",
            ],

            [
                "value"    => "그게 아니야",
                "expected" => "6re46rKMIOyVhOuLiOyVvA==",
            ],

            [
                "value"    => "",
                "expected" => "",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Base64Encode();

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
