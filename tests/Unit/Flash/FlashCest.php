<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Flash;
use Centum\Flash\Formatter\TextFormatter;
use Centum\Flash\Storage;
use Centum\Http\Session\ArraySession;
use Centum\Interfaces\Flash\FlashInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Flash
 */
final class FlashCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $flash = $I->mock(Flash::class);

        $I->assertInstanceOf(FlashInterface::class, $flash);
    }



    public function testOutput(UnitTester $I): void
    {
        $message1 = "sample message 1";
        $message2 = "sample message 2";
        $message3 = "sample message 3";
        $message4 = "sample message 4";



        $session = new ArraySession();

        $storage = new Storage($session);

        $formatter = new TextFormatter();

        $flash = new Flash($storage, $formatter);



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
