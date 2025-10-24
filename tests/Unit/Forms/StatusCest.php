<?php

namespace Tests\Unit\Forms;

use Centum\Forms\Status;
use Centum\Interfaces\Forms\StatusInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Forms\Status
 */
final class StatusCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $status = $I->mock(Status::class);

        $I->assertInstanceOf(StatusInterface::class, $status);
    }



    #[DataProvider("providerIsValid")]
    public function testIsValid(UnitTester $I, Example $example): void
    {
        /** @var array<non-empty-string, list<non-empty-string>> */
        $messages = $example["messages"];

        $status = new Status($messages);

        /** @var bool */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $status->isValid()
        );
    }

    /**
     * @return array<array{messages: array<non-empty-string, list<non-empty-string>>, expected: bool}>
     */
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
        /** @var array<non-empty-string, list<non-empty-string>> */
        $messages = $example["messages"];

        $status = new Status($messages);

        $I->assertEquals(
            $messages,
            $status->getMessages()
        );
    }

    /**
     * @return array<array{messages: array<non-empty-string, list<non-empty-string>>}>
     */
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
