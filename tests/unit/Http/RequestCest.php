<?php

namespace Tests\Http;

use Centum\Http\Request;
use Centum\Forms\Factory;
use Tests\UnitTester;
use Tests\Forms\LoginTemplate;

class RequestCest
{
    public function getters(UnitTester $I) : void
    {
        $request = new Request(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ],
            "Hello world"
        );



        $I->assertEquals(
            "/login",
            $request->getUri()
        );

        $I->assertEquals(
            "POST",
            $request->getMethod()
        );

        $I->assertEquals(
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ],
            $request->getParameters()
        );

        $I->assertEquals(
            "Hello world",
            $request->getContent()
        );
    }

    public function validate(UnitTester $I) : void
    {
        $template = new LoginTemplate();

        $form = Factory::build($template);



        $request = new Request(
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



        $request = new Request(
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



        $request = new Request(
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
