<?php

namespace Tests\Forms;

use Centum\Forms\FormFactory;
use Tests\UnitTester;

class FormFactoryCest
{
    public function test(UnitTester $I): void
    {
        $template = new LoginTemplate();

        $form = FormFactory::createFromTemplate($template);



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
}