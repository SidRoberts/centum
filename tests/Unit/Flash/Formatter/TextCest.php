<?php

namespace Tests\Unit\Flash\Formatter;

use Centum\Flash\Formatter\TextFormatter;
use Centum\Flash\Message;
use Tests\Support\UnitTester;

class TextCest
{
    public function testOutput(UnitTester $I): void
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