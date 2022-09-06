<?php

namespace Tests\Unit\Http;

use Centum\Http\Request;
use Tests\Forms\LoginForm;
use Codeception\Example;
use Exception;
use Tests\UnitTester;

class FormCest
{
    /** @dataProvider provider */
    public function test(UnitTester $I, Example $example): void
    {
        /** @var array */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $container = $I->getContainer();

        $form = new LoginForm($request, $container);

        /** @var array{username: string, password: string} */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected["username"],
            $form->getUsername()
        );

        $I->assertEquals(
            $expected["password"],
            $form->getPassword()
        );
    }

    protected function provider(): array
    {
        return [
            [
                "data" => [
                    "username" => "sidroberts",
                    "password" => "hunter2",
                ],
                "expected" => [
                    "username" => "sidroberts",
                    "password" => "hunter2",
                ],
            ],

            //TODO
        ];
    }



    /** @dataProvider providerBad */
    public function testBad(UnitTester $I, Example $example): void
    {
        /** @var array */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $container = $I->getContainer();

        $I->expectThrowable(
            Exception::class,
            function () use ($request, $container) {
                new LoginForm($request, $container);
            }
        );
    }

    protected function providerBad(): array
    {
        return [
            [
                "data" => [
                    "username" => "sidroberts",
                    "password" => "",
                ],
            ],

            [
                "data" => [
                    "username" => "sidroberts",
                ],
            ],

            [
                "data" => [
                    "username" => "",
                    "password" => "hunter2",
                ],
            ],

            [
                "data" => [
                    "password" => "hunter2",
                ],
            ],

            [
                "data" => [
                    "username" => "",
                    "password" => "",
                ],
            ],

            [
                "data" => [
                    "username" => "",
                ],
            ],

            [
                "data" => [
                    "password" => "",
                ],
            ],

            [
                "data" => [],
            ],
        ];
    }
}
        