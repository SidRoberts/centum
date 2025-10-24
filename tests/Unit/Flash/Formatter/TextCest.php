<?php

namespace Tests\Unit\Flash\Formatter;

use Centum\Flash\Formatter\TextFormatter;
use Centum\Flash\Level;
use Centum\Flash\Message;
use Centum\Interfaces\Flash\FormatterInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Formatter\TextFormatter
 */
final class TextCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $formatter = $I->mock(TextFormatter::class);

        $I->assertInstanceOf(FormatterInterface::class, $formatter);
    }



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
