<?php

namespace Tests\Unit\Http;

use Centum\Http\Data;
use Centum\Http\Exception\CsrfException;
use Centum\Http\Request;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\DataInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Mockery\MockInterface;
use Tests\Support\Forms\LoginForm;
use Tests\Support\Forms\LoginWithCsrfForm;
use Tests\Support\UnitTester;

class FormCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        /** @var DataInterface */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $csrfValidator = $I->mock(ValidatorInterface::class);

        $container = $I->grabContainer();

        $form = new LoginForm($request, $csrfValidator, $container);

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
        /** @var DataInterface */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $csrfValidator = $I->mock(ValidatorInterface::class);

        $container = $I->grabContainer();

        $I->expectThrowable(
            Exception::class,
            function () use ($request, $csrfValidator, $container): void {
                new LoginForm($request, $csrfValidator, $container);
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
        /** @var DataInterface */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $csrfValidator = $I->mock(
            ValidatorInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("validate")
                    ->once();
            }
        );

        $container = $I->grabContainer();

        $form = new LoginWithCsrfForm($request, $csrfValidator, $container);

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
                        "csrf"     => "abcdefghijklmnop",
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
        /** @var DataInterface */
        $data = $example["data"];

        $request = new Request(
            "/",
            "GET",
            $data
        );

        $throwable = new CsrfException(null);

        $csrfValidator = $I->mock(
            ValidatorInterface::class,
            function (MockInterface $mock) use ($throwable): void {
                $mock->shouldReceive("validate")
                    ->andThrow($throwable)
                    ->once();
            }
        );

        $container = $I->grabContainer();

        $I->expectThrowable(
            $throwable,
            function () use ($request, $csrfValidator, $container): void {
                new LoginWithCsrfForm($request, $csrfValidator, $container);
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
