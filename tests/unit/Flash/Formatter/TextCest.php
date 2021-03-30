<?php

namespace Tests\Flash\Formatter;

use Centum\Flash\Formatter\TextFormatter;
use Centum\Flash\Message;
use Tests\UnitTester;

class TextCest
{
    public function output(UnitTester $I): void
    {
        $formatter = new TextFormatter();

        $message = new Message(
            "danger",
            "Hello world"
        );

        $I->assertEquals(
            "[DANGER] Hello world",
            $formatter->output($message)
        );
    }
}
