<?php

namespace Tests\Unit\Http;

use Centum\Forms\FormFactory;
use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\FormRequest;
use Centum\Http\Request;
use Tests\Forms\LoginTemplate;
use Tests\UnitTester;

class FormRequestCest
{
    public function test(UnitTester $I): void
    {
        $template = new LoginTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $request = new Request(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "",
            ]
        );

        $formRequest = new FormRequest($request, $form);

        $status = $formRequest->getStatus();

        $I->assertFalse(
            $status->isValid()
        );

        $I->assertEquals(
            [
                "password" => [
                    "Value is required and can't be empty.",
                ],
            ],
            $status->getMessages()
        );



        $request = new Request(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $formRequest = new FormRequest($request, $form);

        $status = $formRequest->getStatus();

        $I->assertTrue(
            $status->isValid()
        );

        $I->assertEmpty(
            $status->getMessages()
        );
    }
}
