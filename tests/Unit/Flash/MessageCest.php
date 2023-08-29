<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Level;
use Centum\Flash\Message;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Message
 */
class MessageCest
{
    public function testGetLevel(UnitTester $I): void
    {
        $level = Level::DANGER;
        $text  = "sample danger";

        $message = new Message($level, $text);

        $I->assertEquals(
            $level->value,
            $message->getLevel()
        );
    }

    public function testGetText(UnitTester $I): void
    {
        $level = Level::DANGER;
        $text  = "sample danger";

        $message = new Message($level, $text);

        $I->assertEquals(
            $text,
            $message->getText()
        );
    }
}
