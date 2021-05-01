<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Message;
use Centum\Flash\MessageBag;
use Tests\UnitTester;

class MessageBagCest
{
    public function getMessages(UnitTester $I): void
    {
        $messageBag = new MessageBag();



        $I->assertEquals(
            [],
            $messageBag->getMessages()
        );



        $message1 = new Message("danger", "sample danger");
        $message2 = new Message("success", "sample success");
        $message3 = new Message("danger", "sample danger 2");

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
