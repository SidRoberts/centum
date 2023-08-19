<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Level;
use Centum\Flash\Message;
use Centum\Flash\MessageBag;
use Tests\Support\UnitTester;

class MessageBagCest
{
    public function testGetMessages(UnitTester $I): void
    {
        $messageBag = new MessageBag();



        $I->assertEquals(
            [],
            $messageBag->getMessages()
        );



        $message1 = new Message(Level::DANGER, "sample danger");
        $message2 = new Message(Level::SUCCESS, "sample success");
        $message3 = new Message(Level::DANGER, "sample danger 2");

        $messageBag->add($message1);
        $messageBag->add($message2);
        $messageBag->add($message3);



        $expected = [
            $message1,
            $message2,
            $message3,
        ];

        $I->assertEquals(
            $expected,
            $messageBag->getMessages()
        );
    }
}
