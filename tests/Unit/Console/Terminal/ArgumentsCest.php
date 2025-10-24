<?php

namespace Tests\Unit\Console\Terminal;

use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\Terminal\ArgumentsInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Terminal\Arguments
 */
final class ArgumentsCest
{
    public function getArguments(): Arguments
    {
        $argv = [
            "cli.php",
            "middleware:true",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        return new Arguments($argv);
    }



    public function testInterfaces(UnitTester $I): void
    {
        $arguments = $I->mock(Arguments::class);

        $I->assertInstanceOf(ArgumentsInterface::class, $arguments);
    }

    public function testGetFilename(UnitTester $I): void
    {
        $arguments = $this->getArguments();

        $I->assertEquals(
            "cli.php",
            $arguments->getFilename()
        );
    }

    public function testGetCommandName(UnitTester $I): void
    {
        $arguments = $this->getArguments();

        $I->assertEquals(
            "middleware:true",
            $arguments->getCommandName()
        );
    }

    public function testGetParameters(UnitTester $I): void
    {
        $arguments = $this->getArguments();

        $I->assertEquals(
            [
                "i"       => "123",
                "verbose" => true,
                "dry-run" => true,
            ],
            $arguments->getParameters()
        );
    }



    #[DataProvider("providerGet")]
    public function testGet(UnitTester $I, Example $example): void
    {
        /** @var string|bool */
        $expected = $example["expected"];

        $parameters = $this->getArguments();

        /** @var non-empty-string */
        $key = $example["key"];

        $I->assertEquals(
            $expected,
            $parameters->getParameter($key)
        );
    }

    /**
     * @return array<array{key: non-empty-string, expected: string|bool}>
     */
    protected function providerGet(): array
    {
        return [
            [
                "key"      => "i",
                "expected" => "123",
            ],

            [
                "key"      => "verbose",
                "expected" => true,
            ],

            [
                "key"      => "dry-run",
                "expected" => true,
            ],
        ];
    }



    public function testToArray(UnitTester $I): void
    {
        $argv = [
            "cli.php",
            "middleware:true",
            "--i",
            "123",
            "--verbose",
            "--dry-run",
        ];

        $arguments = new Arguments($argv);

        $I->assertEquals(
            $argv,
            $arguments->toArray()
        );
    }
}
