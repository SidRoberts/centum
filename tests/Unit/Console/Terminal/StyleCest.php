<?php

namespace Tests\Unit\Console\Terminal;

use Centum\Console\Terminal\Style;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\Terminal\Style
 */
class StyleCest
{
    public function testBold(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[1mHello\e[0m",
            $style->bold("Hello")
        );
    }

    public function testItalics(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[3mHello\e[23m",
            $style->italics("Hello")
        );
    }

    public function testUnderline(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[4mHello\e[24m",
            $style->underline("Hello")
        );
    }

    public function testHighlight(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[7mHello\e[0m",
            $style->highlight("Hello")
        );
    }

    public function testDim(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[2mHello\e[0m",
            $style->dim("Hello")
        );
    }

    public function testBlink(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[5mHello\e[0m",
            $style->blink("Hello")
        );
    }

    public function testReversed(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[7mHello\e[0m",
            $style->reversed("Hello")
        );
    }



    public function testTextBlack(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[30mHello\e[0m",
            $style->textBlack("Hello")
        );
    }

    public function testTextRed(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[31mHello\e[0m",
            $style->textRed("Hello")
        );
    }

    public function testTextGreen(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[32mHello\e[0m",
            $style->textGreen("Hello")
        );
    }

    public function testTextYellow(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[33mHello\e[0m",
            $style->textYellow("Hello")
        );
    }

    public function testTextBlue(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[34mHello\e[0m",
            $style->textBlue("Hello")
        );
    }

    public function testTextMagenta(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[35mHello\e[0m",
            $style->textMagenta("Hello")
        );
    }

    public function testTextCyan(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[36mHello\e[0m",
            $style->textCyan("Hello")
        );
    }

    public function testTextWhite(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[37mHello\e[0m",
            $style->textWhite("Hello")
        );
    }



    public function testBackgroundBlack(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[40mHello\e[0m",
            $style->backgroundBlack("Hello")
        );
    }

    public function testBackgroundRed(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[41mHello\e[0m",
            $style->backgroundRed("Hello")
        );
    }

    public function testBackgroundGreen(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[42mHello\e[0m",
            $style->backgroundGreen("Hello")
        );
    }

    public function testBackgroundYellow(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[43mHello\e[0m",
            $style->backgroundYellow("Hello")
        );
    }

    public function testBackgroundBlue(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[44mHello\e[0m",
            $style->backgroundBlue("Hello")
        );
    }

    public function testBackgroundMagenta(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[45mHello\e[0m",
            $style->backgroundMagenta("Hello")
        );
    }

    public function testBackgroundCyan(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[46mHello\e[0m",
            $style->backgroundCyan("Hello")
        );
    }

    public function testBackgroundWhite(UnitTester $I): void
    {
        $style = new Style();

        $I->assertEquals(
            "\e[47mHello\e[0m",
            $style->backgroundWhite("Hello")
        );
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
