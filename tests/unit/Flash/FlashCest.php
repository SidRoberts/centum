<?php

namespace Centum\Tests\Flash;

use Centum\Flash\Flash;
use Centum\Flash\Formatter\TextFormatter;
use Centum\Tests\UnitTester;
use Centum\Http\Session;

class FlashCest
{
    public function output(UnitTester $I)
    {
        $message1 = "sample message 1";
        $message2 = "sample message 2";
        $message3 = "sample message 3";
        $message4 = "sample message 4";



        $session   = new Session();
        $formatter = new TextFormatter();

        $flash = new Flash($session, $formatter);



        $flash->danger($message1);
        $flash->success($message2);
        $flash->info($message3);
        $flash->warning($message4);



        $expected = "";

        $expected .= "[DANGER] "  . $message1 . PHP_EOL;
        $expected .= "[SUCCESS] " . $message2 . PHP_EOL;
        $expected .= "[INFO] "    . $message3 . PHP_EOL;
        $expected .= "[WARNING] " . $message4 . PHP_EOL;

        $I->assertEquals(
            $expected,
            $flash->output()
        );
    }
}
