<?php

namespace Tests\Unit\Http;

use Centum\Forms\FormFactory;
use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Request;
use Tests\Forms\LoginTemplate;
use Tests\UnitTester;

class RequestCest
{
    public function testGetters(UnitTester $I): void
    {
        $headers = new Headers();

        $headers->add(
            new Header("cache-control", "no-cache")
        );



        $cookies = new Cookies();

        $cookies->add(
            new Cookie("timezone", "Asia/Seoul")
        );



        $request = new Request(
            "/login",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ],
            $headers,
            $cookies,
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
            [
                "cache-control" => "no-cache",
            ],
            $request->getHeaders()->toArray()
        );

        $I->assertEquals(
            [
                "timezone" => "Asia/Seoul",
            ],
            $request->getCookies()->toArray()
        );

        $I->assertEquals(
            "Hello world",
            $request->getContent()
        );
    }

    public function testValidate(UnitTester $I): void
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

        $status = $request->validate($form);

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

        $status = $request->validate($form);

        $I->assertTrue(
            $status->isValid()
        );

        $I->assertEmpty(
            $status->getMessages()
        );
    }
}
