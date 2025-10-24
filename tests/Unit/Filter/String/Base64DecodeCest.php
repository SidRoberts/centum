<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Base64Decode;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\Base64Decode
 */
final class Base64DecodeCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(Base64Decode::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

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
                "input"  => "SGVsbG8=",
                "output" => "Hello",
            ],

            [
                "input"  => "6re46rKMIOyVhOuLiOyVvA==",
                "output" => "그게 아니야",
            ],

            [
                "input"  => "",
                "output" => "",
            ],
        ];
    }



    #[DataProvider("providerExceptionNotString")]
    public function testExceptionNotString(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a string."),
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: mixed}>
     */
    protected function providerExceptionNotString(): array
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



    #[DataProvider("providerExceptionBase64")]
    public function testExceptionBase64(UnitTester $I, Example $example): void
    {
        $filter = new Base64Decode();

        $I->expectFilterThrowable(
            new InvalidArgumentException("Value must be a valid base64 string."),
            $filter,
            $example["input"]
        );
    }

    /**
     * @return array<array{input: string}>
     */
    protected function providerExceptionBase64(): array
    {
        return [
            [
                "input" => "This is not a valid base64 string.",
            ],
        ];
    }
}
