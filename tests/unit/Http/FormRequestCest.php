<?php

namespace Tests\Unit\Http;

use Centum\Forms\FormFactory;
use Centum\Http\FormRequest;
use Centum\Http\Request;
use Tests\Forms\UserTemplate;
use Tests\Models\User;
use Tests\UnitTester;

class FormRequestCest
{
    public function test(UnitTester $I): void
    {
        $template = new UserTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $request = new Request(
            "/register",
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
            "/register",
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

    public function testGetters(UnitTester $I): void
    {
        $template = new UserTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $request = new Request(
            "/register",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $formRequest = new FormRequest($request, $form);

        $I->assertEquals(
            "sidroberts",
            $formRequest->get("username")
        );

        $I->assertEquals(
            "hunter2",
            $formRequest->get("password")
        );

        $I->assertEquals(
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ],
            $formRequest->getData()
        );
    }

    public function testBind(UnitTester $I): void
    {
        $template = new UserTemplate();

        $formFactory = new FormFactory();

        $form = $formFactory->createFromTemplate($template);



        $request = new Request(
            "/register",
            "POST",
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $formRequest = new FormRequest($request, $form);

        $user = new User();

        $formRequest->bind($user);

        $I->assertEquals(
            "sidroberts",
            $user->getUsername()
        );

        $I->assertEquals(
            "hunter2",
            $user->getPassword()
        );
    }
}
