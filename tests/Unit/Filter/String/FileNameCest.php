<?php

namespace Tests\Unit\Filter\String;

use Centum\Filter\String\FileName;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Filter\String\FileName
 */
final class FileNameCest
{
    #[DataProvider("providerGood")]
    public function testGood(UnitTester $I, Example $example): void
    {
        $filter = new FileName();

        /** @var string */
        $input = $example["input"];

        /** @var string */
        $replacement = $example["replacement"];

        /** @var string */
        $expected = $example["expected"];

        $output = $filter->filter($input, $replacement);

        $I->assertSame(
            $expected,
            $output
        );
    }

    protected function providerGood(): array
    {
        return [
            [
                "input"       => "c:\\Windows\\System32\\Drivers\\etc\\hosts",
                "replacement" => "_",
                "expected"    => "c__Windows_System32_Drivers_etc_hosts",
            ],

            [
                "input"       => "This/That.mp3",
                "replacement" => "_",
                "expected"    => "This_That.mp3",
            ],
        ];
    }



    public function testEmpty(UnitTester $I): void
    {
        $filter = new FileName();

        $I->expectFilterThrowable(
            new Exception("Not a valid filename."),
            $filter,
            ""
        );
    }

    public function testTrim(UnitTester $I): void
    {
        $filter = new FileName();

        $I->expectFilterOutput(
            $filter,
            "  image  ",
            "image"
        );
    }
}
