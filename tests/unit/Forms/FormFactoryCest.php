<?php

namespace Tests\Unit\Forms;

use Centum\Container\Container;
use Centum\Forms\FormFactory;
use Tests\Forms\UserTemplate;
use Tests\Forms\UserWithConstructorTemplate;
use Tests\UnitTester;

class FormFactoryCest
{
    public function test(UnitTester $I): void
    {
        $template = new UserTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $status = $form->validate(
            [
                "username" => "",
                "password" => "",
            ]
        );

        $messages = $status->getMessages();

        $I->assertArrayHasKey("username", $messages);
        $I->assertArrayHasKey("password", $messages);

        $I->assertEquals(
            [
                "Value is required and can't be empty.",
            ],
            $messages["username"]
        );

        $I->assertEquals(
            [
                "Value is required and can't be empty.",
            ],
            $messages["password"]
        );



        $status = $form->validate(
            [
                "username" => "username",
                "password" => "password",
            ]
        );

        $I->assertTrue(
            $status->isValid()
        );
    }

    public function testWithConstructor(UnitTester $I): void
    {
        $container = new Container();

        $template = new UserWithConstructorTemplate($container);

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $status = $form->validate(
            [
                "username" => "username",
                "password" => "password",
            ]
        );

        $I->assertTrue(
            $status->isValid()
        );
    }
}
