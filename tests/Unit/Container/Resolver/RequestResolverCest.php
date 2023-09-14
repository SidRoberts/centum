<?php

namespace Tests\Unit\Container\Resolver;

use Centum\Container\Exception\FileGroupNotFoundException;
use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Data;
use Centum\Http\File;
use Centum\Http\FileGroup;
use Centum\Http\Files;
use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Router;
use Tests\Support\Controllers\CookiesController;
use Tests\Support\Controllers\ParametersController;
use Tests\Support\Http\Forms\UploadForm;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Resolver\RequestResolver
 */
class RequestResolverCest
{
    public function test(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = new Router($container);

        $group = $router->group();

        $group->get("/", ParametersController::class, "requestFromContainer");

        $request = new Request("/");

        $response = $router->handle($request);

        $I->assertEquals(
            $request::class,
            $response->getContent()
        );
    }



    public function testCookies(UnitTester $I): void
    {
        $cookies = new Cookies(
            [
                new Cookie("username", "SidRoberts"),
            ]
        );

        $router = $I->grabFromContainer(RouterInterface::class);

        $group = $router->group();

        $group->get("/cookies", CookiesController::class, "resolverCookies");

        $request = new Request("/cookies", Method::GET, null, null, $cookies);

        $response = $router->handle($request);

        $I->assertEquals(
            serialize($cookies),
            $response->getContent()
        );
    }

    public function testCookie(UnitTester $I): void
    {
        $cookies = new Cookies(
            [
                new Cookie("username", "SidRoberts"),
            ]
        );

        $router = $I->grabFromContainer(RouterInterface::class);

        $group = $router->group();

        $group->get("/cookie", CookiesController::class, "resolverCookie");

        $request = new Request("/cookie", Method::GET, null, null, $cookies);

        $response = $router->handle($request);

        $I->assertEquals(
            "SidRoberts",
            $response->getContent()
        );
    }

    public function testCookieOptionalSet(UnitTester $I): void
    {
        $cookies = new Cookies(
            [
                new Cookie("username", "SidRoberts"),
            ]
        );

        $router = $I->grabFromContainer(RouterInterface::class);

        $group = $router->group();

        $group->get("/cookie-optional", CookiesController::class, "resolverCookieOptional");

        $request = new Request("/cookie-optional", Method::GET, null, null, $cookies);

        $response = $router->handle($request);

        $I->assertEquals(
            "SidRoberts",
            $response->getContent()
        );
    }

    public function testCookieOptionalNotSet(UnitTester $I): void
    {
        $router = $I->grabFromContainer(RouterInterface::class);

        $group = $router->group();

        $group->get("/cookie-optional", CookiesController::class, "resolverCookieOptional");

        $request = new Request("/cookie-optional");

        $response = $router->handle($request);

        $I->assertEquals(
            "username not set.",
            $response->getContent()
        );
    }



    public function testFiles(UnitTester $I): void
    {
        $data = new Data([]);



        $fileGroup = new FileGroup("images");

        $file1 = new File("image1.png", "image/png", 123, "/tmp/php/php1aaa11", UPLOAD_ERR_OK);
        $file2 = new File("image2.png", "image/png", 456, "/tmp/php/php2aaa22", UPLOAD_ERR_OK);

        $fileGroup->add($file1);
        $fileGroup->add($file2);

        $files = new Files(
            [
                $fileGroup,
            ]
        );



        $form = $I->buildForm(UploadForm::class, $data, $files);

        $I->assertEquals(
            $fileGroup,
            $form->getImages()
        );
    }

    public function testFilesNotSet(UnitTester $I): void
    {
        $data  = new Data([]);
        $files = new Files();

        $I->expectFormThrowable(
            FileGroupNotFoundException::class,
            UploadForm::class,
            $data,
            $files
        );
    }
}
