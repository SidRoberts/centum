<?php

namespace Tests\Forms;

use Centum\Forms\Factory;
use Tests\UnitTester;

class FactoryCest
{
    public function test(UnitTester $I) : void
    {
        $template = new LoginTemplate();

        $form = Factory::build($template);



        $messages = $form->getMessages(
            []
        );

        $I->assertArrayHasKey("username", $messages);
        $I->assertArrayHasKey("password", $messages);

        $I->assertArrayHasKey("isEmpty", $messages["username"]);
        $I->assertArrayHasKey("isEmpty", $messages["password"]);



        $I->assertTrue(
            $form->isValid(
                [
                    "username" => "username",
                    "password" => "password",
                ]
            )
        );
    }
}
