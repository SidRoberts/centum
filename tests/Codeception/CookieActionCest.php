<?php

namespace Tests\Codeception;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Tests\Support\CodeceptionTester;
use Tests\Support\Controllers\CookiesController;

/**
 * @covers \Centum\Codeception\Actions\CookieActions
 */
class CookieActionsCest
{
    public function testGrabCookies(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");


        $I->amOnPage("/cookies");

        $cookies = $I->grabCookies();

        $I->assertEquals(
            new Cookies(
                [
                    new Cookie("username", "SidRoberts"),
                ]
            ),
            $cookies
        );
    }



    public function testGrabCookieValue(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");



        $I->amOnPage("/cookies");

        $cookieValue = $I->grabCookieValue("username");

        $I->assertEquals(
            "SidRoberts",
            $cookieValue
        );
    }



    public function testSeeCookie(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");



        $I->amOnPage("/cookies");

        $I->seeCookie("username");
    }

    public function testDontSeeCookie(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");



        $I->amOnPage("/cookies");

        $I->dontSeeCookie("password");
    }



    public function testSeeCookieValueIs(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");



        $I->amOnPage("/cookies");

        $I->seeCookieValueIs("username", "SidRoberts");
    }

    public function testDontSeeCookieValueIs(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/cookies", CookiesController::class, "index");



        $I->amOnPage("/cookies");

        $I->dontSeeCookieValueIs("username", "my-alt-account");
        $I->dontSeeCookieValueIs("password", "hunter2");
    }
}
