<?php

namespace Tests\Unit\Forms;

use Centum\Forms\Status;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class StatusCest
{
    #[DataProvider("providerIsValid")]
    public function testIsValid(UnitTester $I, Example $example): void
    {
        /** @var array<string, string[]> */
        $messages = $example["messages"];

        $status = new Status($messages);

        /** @var bool */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $status->isValid()
        );
    }

    protected function providerIsValid(): array
    {
        return [
            [
                "messages" => [],
                "expected" => true,
            ],

            [
                "messages" => [
                    "password" => ["Password is too short."],
                ],
                "expected" => false,
            ],

            [
                "messages" => [
                    "username" => ["Username is required."],
                    "password" => ["Passwords don't match."],
                ],
                "expected" => false,
            ],
        ];
    }



    #[DataProvider("providerGetMessages")]
    public function testGetMessages(UnitTester $I, Example $example): void
    {
        /** @var array<string, string[]> */
        $messages = $example["messages"];

        $status = new Status($messages);

        $I->assertEquals(
            $messages,
            $status->getMessages()
        );
    }

    protected function providerGetMessages(): array
    {
        return [
            [
                "messages" => [],
            ],

            [
                "messages" => [
                    "password" => ["Password is too short."],
                ],
            ],

            [
                "messages" => [
                    "username" => ["Username is required."],
                    "password" => ["Passwords don't match."],
                ],
            ],
        ];
    }
}
