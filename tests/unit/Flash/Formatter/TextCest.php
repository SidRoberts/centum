<?php

namespace Tests\Flash\Formatter;

use Centum\Flash\Formatter\TextFormatter;
use Tests\UnitTester;

class TextCest
{
    public function output(UnitTester $I)
    {
        $formatter = new TextFormatter();

        $message = "Hello world";

        $expected = "[DANGER] " . $message;

        $I->assertEquals(
            $expected,
            $formatter->output("danger", $message)
        );
    }
}
