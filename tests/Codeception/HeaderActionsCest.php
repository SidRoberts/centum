<?php

namespace Tests\Codeception;

use Centum\Http\Header;
use Centum\Http\Headers;
use Tests\Support\CodeceptionTester;
use Tests\Support\Controllers\HeadersController;

class HeaderActionsCest
{
    public function testGrabHeaders(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");


        $I->amOnPage("/headers");

        $headers = $I->grabHeaders();

        $I->assertEquals(
            new Headers(
                [
                    new Header("Cache-Control", "max-age"),
                ]
            ),
            $headers
        );
    }



    public function testGrabHeaderValue(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");



        $I->amOnPage("/headers");

        $headerValue = $I->grabHeaderValue("Cache-Control");

        $I->assertEquals(
            "max-age",
            $headerValue
        );
    }



    public function testSeeHeader(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");



        $I->amOnPage("/headers");

        $I->seeHeader("Cache-Control");
    }

    public function testDontSeeHeader(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");



        $I->amOnPage("/headers");

        $I->dontSeeHeader("ETag");
    }



    public function testSeeHeaderValueIs(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");



        $I->amOnPage("/headers");

        $I->seeHeaderValueIs("Cache-Control", "max-age");
    }

    public function testDontSeeHeaderValueIs(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/headers", HeadersController::class, "index");



        $I->amOnPage("/headers");

        $I->dontSeeHeaderValueIs("Cache-Control", "must-revalidate");
        $I->dontSeeHeaderValueIs("ETag", "afasdf");
    }
}
