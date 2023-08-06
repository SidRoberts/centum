<?php

namespace Tests\Unit\Http;

use Centum\Http\Data;
use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Http\DataInterface;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use InvalidArgumentException;
use Tests\Support\Http\Forms\FormWithoutAConstructor;
use Tests\Support\Http\Forms\LoginForm;
use Tests\Support\Http\Forms\LoginWithCsrfForm;
use Tests\Support\UnitTester;
use Throwable;

class FormBuilderCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        /** @var DataInterface */
        $data = $example["data"];

        $form = $I->buildForm(LoginForm::class, $data);

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



    public function testFormWithoutAConstructor(UnitTester $I): void
    {
        $data = $I->mock(DataInterface::class);

        $I->expectThrowable(
            new InvalidArgumentException(
                sprintf(
                    "%s does not have a constructor.",
                    FormWithoutAConstructor::class
                )
            ),
            function () use ($I, $data): void {
                $I->buildForm(
                    FormWithoutAConstructor::class,
                    $data
                );
            }
        );
    }



    #[DataProvider("providerBad")]
    public function testBad(UnitTester $I, Example $example): void
    {
        /** @var Throwable */
        $throwable = $example["throwable"];

        /** @var DataInterface */
        $data = $example["data"];

        $I->expectFormThrowable(
            $throwable,
            LoginForm::class,
            $data
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
                "throwable" => new Exception("Password is too short."),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "sidroberts",
                    ]
                ),
                "throwable" => new Exception("'password' is required."),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                        "password" => "hunter2",
                    ]
                ),
                "throwable" => new Exception("Username cannot be empty."),
            ],

            [
                "data" => new Data(
                    [
                        "password" => "hunter2",
                    ]
                ),
                "throwable" => new Exception("'username' is required."),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                        "password" => "",
                    ]
                ),
                "throwable" => new Exception("Username cannot be empty."),
            ],

            [
                "data" => new Data(
                    [
                        "username" => "",
                    ]
                ),
                "throwable" => new Exception("'password' is required."),
            ],

            [
                "data" => new Data(
                    [
                        "password" => "",
                    ]
                ),
                "throwable" => new Exception("'username' is required."),
            ],

            [
                "data"      => new Data([]),
                "throwable" => new Exception("'username' is required."),
            ],
        ];
    }



    #[DataProvider("providerCsrf")]
    public function testCsrf(UnitTester $I, Example $example): void
    {
        /** @var DataInterface */
        $data = $example["data"];

        $I->assumeCsrfIsValid();

        $form = $I->buildForm(LoginWithCsrfForm::class, $data);

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

        $I->expectFormThrowable(
            new CsrfException(null),
            LoginWithCsrfForm::class,
            $data
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
