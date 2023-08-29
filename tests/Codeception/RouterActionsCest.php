<?php

namespace Tests\Codeception;

use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Router\RouterInterface;
use Tests\Support\CodeceptionTester;
use Tests\Support\Controllers\ExceptionController;
use Tests\Support\Controllers\ExceptionHandler;
use Tests\Support\Controllers\HtmlController;
use Tests\Support\Controllers\IndexController;
use Tests\Support\Controllers\RedirectController;
use Tests\Support\Controllers\RouteNotFoundExceptionHandler;

/**
 * @covers \Centum\Codeception\Actions\RouterActions
 */
class RouterActionsCest
{
    public function testGrabRouter(CodeceptionTester $I): void
    {
        $routerFromContainer = $I->grabFromContainer(RouterInterface::class);

        $router = $I->grabRouter();

        $I->assertSame(
            $routerFromContainer,
            $router
        );
    }

    public function testMakeRouterGroup(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testStartFollowingRedirects(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/redirect/1", RedirectController::class, "redirect1");
        $group->get("/redirect/2", RedirectController::class, "redirect2");
        $group->get("/redirect/3", RedirectController::class, "redirect3");
        $group->get("/redirect/finish", RedirectController::class, "finish");



        $I->startFollowingRedirects();

        $I->amOnPage("/redirect/1");

        $I->seeResponseCodeIs(200);

        $content = $I->grabResponseContent();

        $I->assertEquals(
            "finished redirecting",
            $content
        );
    }

    public function testStopFollowingRedirects(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/redirect/1", RedirectController::class, "redirect1");
        $group->get("/redirect/2", RedirectController::class, "redirect2");
        $group->get("/redirect/3", RedirectController::class, "redirect3");
        $group->get("/redirect/finish", RedirectController::class, "finish");



        $I->stopFollowingRedirects();

        $I->amOnPage("/redirect/1");

        $I->seeResponseCodeIs(302);
    }



    public function testGrabCurrentUri(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");

        $group->get("/redirect/1", RedirectController::class, "redirect1");
        $group->get("/redirect/2", RedirectController::class, "redirect2");
        $group->get("/redirect/3", RedirectController::class, "redirect3");
        $group->get("/redirect/finish", RedirectController::class, "finish");



        $I->amOnPage("/");

        $currentURI = $I->grabCurrentUri();

        $I->assertEquals(
            "/",
            $currentURI
        );



        $I->amOnPage("/redirect/1");

        $currentURI = $I->grabCurrentUri();

        $I->assertEquals(
            "/redirect/finish",
            $currentURI
        );
    }

    public function testSeeCurrentUriEquals(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");

        $group->get("/redirect/1", RedirectController::class, "redirect1");
        $group->get("/redirect/2", RedirectController::class, "redirect2");
        $group->get("/redirect/3", RedirectController::class, "redirect3");
        $group->get("/redirect/finish", RedirectController::class, "finish");

        $I->amOnPage("/");

        $I->seeCurrentUriEquals("/");

        $I->amOnPage("/redirect/1");

        $I->seeCurrentUriEquals("/redirect/finish");
    }



    public function testSeeRouteExists(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");



        $request = new Request("/", Method::GET);

        $I->seeRouteExists($request);
    }

    public function testSeeRouteNotFound(CodeceptionTester $I): void
    {
        $request = new Request("/page/that/doesnt/exist", Method::GET);

        $I->seeRouteNotFound($request);
    }



    public function testAmOnPage(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testHandleRequest(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testFollowRedirect(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testGrabResponseContent(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");



        $I->amOnPage("/");

        $content = $I->grabResponseContent();

        $I->assertEquals(
            "homepage",
            $content
        );
    }

    public function testSeeResponseContentEquals(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");



        $I->amOnPage("/");

        $I->seeResponseContentEquals(
            "homepage"
        );
    }

    public function testSeeResponseContentContains(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->seeResponseContentContains(
            "<blockquote>"
        );
    }



    public function testGrabResponseCode(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");



        $I->amOnPage("/");

        $responseCode = $I->grabResponseCode();

        $I->assertEquals(
            200,
            $responseCode
        );
    }

    public function testSeeResponseCodeIs(CodeceptionTester $I): void
    {
        $router = $I->grabRouter();

        $router->addExceptionHandler(
            RouteNotFoundExceptionHandler::class
        );

        $I->amOnPage("/page/that/doesnt/exist");

        $I->seeResponseCodeIs(404);
    }

    public function testSeeResponseCodeIsNot(CodeceptionTester $I): void
    {
        $router = $I->grabRouter();

        $router->addExceptionHandler(
            RouteNotFoundExceptionHandler::class
        );

        $I->amOnPage("/page/that/doesnt/exist");

        $I->seeResponseCodeIsNot(200);
    }

    public function testSeeResponseCodeIsSuccessful(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/", IndexController::class, "index");



        $I->amOnPage("/");

        $I->seeResponseCodeIsSuccessful();
    }

    public function testSeeResponseCodeIsServerError(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/internal-server-error", ExceptionController::class, "index");

        $router = $I->grabRouter();

        $router->addExceptionHandler(
            ExceptionHandler::class
        );


        $I->amOnPage("/internal-server-error");

        $I->seeResponseCodeIsServerError();
    }

    public function testSeePageNotFound(CodeceptionTester $I): void
    {
        $router = $I->grabRouter();

        $router->addExceptionHandler(
            RouteNotFoundExceptionHandler::class
        );

        $I->amOnPage("/page/that/doesnt/exist");

        $I->seePageNotFound();
    }
}
