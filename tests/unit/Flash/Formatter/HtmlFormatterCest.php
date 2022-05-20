<?php

namespace Tests\Unit\Flash\Formatter;

use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Flash\Message;
use Tests\UnitTester;

class HtmlFormatterCest
{
    public function testOutput(UnitTester $I): void
    {
        $formatter = new HtmlFormatter();

        $message = new Message(
            "danger",
            "Hello world"
        );

        $I->assertEquals(
            "<div class=\"alert alert-danger\">Hello world</div>",
            $formatter->output($message)
        );
    }
}
