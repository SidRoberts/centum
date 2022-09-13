<?php

namespace Tests\Unit\Http;

use Centum\Http\Data;
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
        /** @var Data */
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
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                        "password" => "hunter2",
                    ]
                ),
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
        /** @var Data */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $container = $I->getContainer();

        $I->expectThrowable(
            Exception::class,
            function () use ($request, $container): void {
                new LoginForm($request, $container);
            }
        );
    }

    protected function providerBad(): array
    {
        return [
            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                        "password" => "",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                        "password" => "hunter2",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "password" => "hunter2",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                        "password" => "",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "password" => "",
                    ]
                ),
            ],

            [
                "data" => new Data([]),
            ],
        ];
    }
}
        