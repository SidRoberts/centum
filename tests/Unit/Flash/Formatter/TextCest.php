<?php

namespace Tests\Unit\Flash\Formatter;

use Centum\Flash\Formatter\TextFormatter;
use Centum\Flash\Level;
use Centum\Flash\Message;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Formatter\TextFormatter
 */
class TextCest
{
    public function testOutput(UnitTester $I): void
    {
        $formatter = new TextFormatter();

        $message = new Message(
            Level::DANGER,
            "Hello world"
        );

        $I->assertEquals(
            "[DANGER] Hello world",
            $formatter->output($message)
        );
    }
}
