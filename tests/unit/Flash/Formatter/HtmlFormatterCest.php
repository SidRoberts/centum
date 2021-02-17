<?php

namespace Tests\Flash\Formatter;

use Centum\Flash\Formatter\HtmlFormatter;
use Tests\UnitTester;

class HtmlFormatterCest
{
    public function output(UnitTester $I)
    {
        $formatter = new HtmlFormatter();

        $message = "Hello world";

        $expected = "<div class=\"alert alert-danger\">" . $message . "</div>";

        $I->assertEquals(
            $expected,
            $formatter->output("danger", $message)
        );
    }
}
