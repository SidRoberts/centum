<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\Rot13;
use Centum\Interfaces\Filter\FilterInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use InvalidArgumentException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\Rot13
 */
final class Rot13Cest
{
    public function testInterfaces(UnitTester $I): void
    {
        $filter = $I->mock(Rot13::class);

        $I->assertInstanceOf(FilterInterface::class, $filter);
    }



    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        $filter = new Rot13();

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
                "input"  => "Sid Roberts",
                "output" => "Fvq Eboregf",
            ],

            [
                "input"  => "SidRoberts92",
                "output" => "FvqEboregf92",
            ],

            [
                "input"  => "sid@sidroberts.co.uk",
                "output" => "fvq@fvqeboregf.pb.hx",
            ],

            [
                "input"  => "This is a sentence.",
                "output" => "Guvf vf n fragrapr.",
            ],

            [
                "input"  => "https://github.com/SidRoberts/centum",
                "output" => "uggcf://tvguho.pbz/FvqEboregf/praghz",
            ],

            [
                "input"  => "그게 아니야",
                "output" => "그게 아니야",
            ],
        ];
    }



    #[DataProvider("providerException")]
    public function testException(UnitTester $I, Example $example): void
    {
        $filter = new Rot13();

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
