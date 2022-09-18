<?php

namespace Tests\Unit\Console\Terminal;

use Centum\Console\Terminal\Style;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class StyleCest
{
    #[DataProvider("providerDecorations")]
    public function testDecorations(UnitTester $I, Example $example): void
    {
        $style = new Style();

        $I->assertEquals(
            $example["expected"],
            call_user_func_array([$style, $example["method"]], ["Hello"])
        );
    }

    protected function providerDecorations(): array
    {
        return [
            [
                "expected" => "\e[1mHello\e[0m",
                "method"   => "bold",
            ],
            [
                "expected" => "\e[3mHello\e[23m",
                "method"   => "italics",
            ],
            [
                "expected" => "\e[4mHello\e[24m",
                "method"   => "underline",
            ],

            [
                "expected" => "\e[7mHello\e[0m",
                "method"   => "highlight",
            ],
            [
                "expected" => "\e[2mHello\e[0m",
                "method"   => "dim",
            ],

            [
                "expected" => "\e[5mHello\e[0m",
                "method"   => "blink",
            ],
            [
                "expected" => "\e[7mHello\e[0m",
                "method"   => "reversed",
            ],
        ];
    }



    #[DataProvider("providerColors")]
    public function testColors(UnitTester $I, Example $example): void
    {
        $style = new Style();

        $I->assertEquals(
            $example["expected"],
            call_user_func_array([$style, $example["method"]], ["Hello"])
        );
    }

    protected function providerColors(): array
    {
        return [
            [
                "expected" => "\e[30mHello\e[0m",
                "method"   => "textBlack",
            ],
            [
                "expected" => "\e[31mHello\e[0m",
                "method"   => "textRed",
            ],
            [
                "expected" => "\e[32mHello\e[0m",
                "method"   => "textGreen",
            ],
            [
                "expected" => "\e[33mHello\e[0m",
                "method"   => "textYellow",
            ],
            [
                "expected" => "\e[34mHello\e[0m",
                "method"   => "textBlue",
            ],
            [
                "expected" => "\e[35mHello\e[0m",
                "method"   => "textMagenta",
            ],
            [
                "expected" => "\e[36mHello\e[0m",
                "method"   => "textCyan",
            ],
            [
                "expected" => "\e[37mHello\e[0m",
                "method"   => "textWhite",
            ],

            [
                "expected" => "\e[40mHello\e[0m",
                "method"   => "backgroundBlack",
            ],
            [
                "expected" => "\e[41mHello\e[0m",
                "method"   => "backgroundRed",
            ],
            [
                "expected" => "\e[42mHello\e[0m",
                "method"   => "backgroundGreen",
            ],
            [
                "expected" => "\e[43mHello\e[0m",
                "method"   => "backgroundYellow",
            ],
            [
                "expected" => "\e[44mHello\e[0m",
                "method"   => "backgroundBlue",
            ],
            [
                "expected" => "\e[45mHello\e[0m",
                "method"   => "backgroundMagenta",
            ],
            [
                "expected" => "\e[46mHello\e[0m",
                "method"   => "backgroundCyan",
            ],
            [
                "expected" => "\e[47mHello\e[0m",
                "method"   => "backgroundWhite",
            ],
        ];
    }



    public function testCombinedColors(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[31mRed\e[32mGreen\e[0m\e[31m\e[34mBlue\e[0m\e[31mRed\e[0m",
            $style->textRed(
                "Red" . $style->textGreen("Green") . $style->textBlue("Blue") . "Red"
            )
        );
    }



    public function testColorTextAndBackground(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[31m\e[47mDanger\e[0m\e[31m\e[0m",
            $style->textRed(
                $style->backgroundWhite(
                    "Danger"
                )
            )
        );
    }



    public function testReset(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[0m",
            $style->reset()
        );
    }
}
