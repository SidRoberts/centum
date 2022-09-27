<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Base64Decode;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

class Base64DecodeCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

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
                "value"    => "SGVsbG8=",
                "expected" => "Hello",
            ],

            [
                "value"    => "6re46rKMIOyVhOuLiOyVvA==",
                "expected" => "그게 아니야",
            ],

            [
                "value"    => "",
                "expected" => "",
            ],
        ];
    }



    #[DataProvider("providerExceptionNotString")]
    public function testExceptionNotString(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

        /** @var mixed */
        $value = $example["value"];

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a string."),
            function () use ($filter, $value): void {
                $filter->filter($value);
            }
        );
    }

    protected function providerExceptionNotString(): array
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



    #[DataProvider("providerExceptionBase64")]
    public function testExceptionBase64(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

        /** @var mixed */
        $value = $example["value"];

        $I->expectThrowable(
            new InvalidArgumentException("Value must be a valid base64 string."),
            function () use ($filter, $value): void {
                $filter->filter($value);
            }
        );
    }

    protected function providerExceptionBase64(): array
    {
        return [
            [
                "value" => "This is not a valid base64 string.",
            ],
        ];
    }
}
