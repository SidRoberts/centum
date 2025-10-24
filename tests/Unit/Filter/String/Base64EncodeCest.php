<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Base64Encode;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\Base64Encode
 */
final class Base64EncodeCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(Base64Encode::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Base64Encode();

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
                "input"  => "Hello",
                "output" => "SGVsbG8=",
            ],

            [
                "input"  => "그게 아니야",
                "output" => "6re46rKMIOyVhOuLiOyVvA==",
            ],

            [
                "input"  => "",
                "output" => "",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Base64Encode();

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
