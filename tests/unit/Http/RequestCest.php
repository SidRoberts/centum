<?php

namespace Tests\Http;

use Centum\Http\Request;
use Centum\Forms\Factory;
use Tests\UnitTester;
use Tests\Forms\LoginTemplate;

class RequestCest
{
    public function validate(UnitTester $I) : void
    {
        $template = new LoginTemplate();

        $form = Factory::build($template);



        $request = Request::create(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "",
            ]
        );

        $I->assertFalse(
            $request->validate($form)
        );



        $request = Request::create(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $I->assertTrue(
            $request->validate($form)
        );
    }

    public function getValidationMessages(UnitTester $I) : void
    {
        $template = new LoginTemplate();

        $form = Factory::build($template);



        $request = Request::create(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "",
            ]
        );



        $I->assertEquals(
            [
                "password" => [
                    "isEmpty" => "Value is required and can't be empty",
                ],
            ],
            $request->getValidationMessages($form)
        );
    }
}
