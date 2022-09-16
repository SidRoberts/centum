<?php

namespace Tests\Unit\Http;

use Centum\Http\Csrf;
use Centum\Http\Data;
use Centum\Http\Request;
use Tests\Forms\LoginForm;
use Codeception\Example;
use Exception;
use Mockery;
use Mockery\MockInterface;
use Tests\Forms\LoginWithCsrfForm;
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

        $csrf = Mockery::mock(
            Csrf::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $container = $I->getContainer();

        $form = new LoginForm($request, $csrf, $container);

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

        $csrf = Mockery::mock(
            Csrf::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->andReturn("abcdefghijklmnop");
            }
        );

        $container = $I->getContainer();

        $I->expectThrowable(
            Exception::class,
            function () use ($request, $csrf, $container): void {
                new LoginForm($request, $csrf, $container);
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



    /** @dataProvider providerCsrf */
    public function testCsrf(UnitTester $I, Example $example): void
    {
        /** @var Data */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $csrf = Mockery::mock(
            Csrf::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("validate")
                    ->with("abcdefghijklmnop")
                    ->andReturnTrue();
            }
        );

        $container = $I->getContainer();

        $form = new LoginWithCsrfForm($request, $csrf, $container);

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

    protected function providerCsrf(): array
    {
        return [
            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                        "password" => "hunter2",
                        "csrf"     => "abcdefghijklmnop"
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



    /** @dataProvider providerCsrfBad */
    public function testCsrfBad(UnitTester $I, Example $example): void
    {
        /** @var Data */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $csrf = Mockery::mock(
            Csrf::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("validate")
                    ->withAnyArgs()
                    ->andReturnFalse();
            }
        );

        $container = $I->getContainer();

        $I->expectThrowable(
            new Exception("CSRF does not match."),
            function () use ($request, $csrf, $container): void {
                new LoginWithCsrfForm($request, $csrf, $container);
            }
        );
    }

    protected function providerCsrfBad(): array
    {
        return [
            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                        "password" => "hunter2",
                    ]
                ),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                        "password" => "hunter2",
                        "csrf"     => "bad-csrf-token",
                    ]
                ),
            ],
        ];
    }
}
