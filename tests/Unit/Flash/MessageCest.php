<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Level;
use Centum\Flash\Message;
use Centum\Interfaces\Flash\MessageInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Message
 */
final class MessageCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $message = $I->mock(Message::class);

        $I->assertInstanceOf(MessageInterface::class, $message);
    }



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
