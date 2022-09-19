<?php

namespace Tests\Unit\Http;

use Centum\Http\Csrf;
use Centum\Http\Data;
use Centum\Http\Request;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\Forms\LoginForm;
use Tests\Support\Forms\LoginWithCsrfForm;
use Tests\Support\UnitTester;

class FormCest
{
    #[DataProvider("provider")]
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



    #[DataProvider("providerBad")]
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
        $data = [
            [
                "username" => "sidroberts",
                "password" => "",
            ],

            [
                "username" => "sidroberts",
            ],

            [
                "username" => "",
                "password" => "hunter2",
            ],

            [
                "password" => "hunter2",
            ],

            [
                "username" => "",
                "password" => "",
            ],

            [
                "username" => "",
            ],

            [
                "password" => "",
            ],

            [],
        ];

        return array_map(
            function (array $data): array {
                return [
                    "data" => new Data($data),
                ];
            },
            $data
        );
    }



    #[DataProvider("providerCsrf")]
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



    #[DataProvider("providerCsrfBad")]
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
        $data = [
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ],

            [
                "username" => "sidroberts",
                "password" => "hunter2",
                "csrf"     => "bad-csrf-token",
            ],
        ];

        return array_map(
            function (array $data): array {
                return [
                    "data" => new Data($data),
                ];
            },
            $data
        );
    }
}
