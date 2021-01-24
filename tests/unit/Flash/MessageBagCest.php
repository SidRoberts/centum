<?php

namespace Centum\Tests\Flash;

use Centum\Flash\MessageBag;
use Centum\Tests\UnitTester;

class MessageBagCest
{
    public function getMessages(UnitTester $I)
    {
        $messageBag = new MessageBag();



        $I->assertEquals(
            [],
            $messageBag->getMessages()
        );



        $messageBag->add("danger", "sample danger");
        $messageBag->add("success", "sample success");
        $messageBag->add("danger", "sample danger 2");



        $expected = [
            [
                "level"   => "danger",
                "message" => "sample danger",
            ],
            [
                "level"   => "success",
                "message" => "sample success",
            ],
            [
                "level"   => "danger",
                "message" => "sample danger 2",
            ],
        ];

        $I->assertEquals(
            $expected,
            $messageBag->getMessages()
        );
    }
}
