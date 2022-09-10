<?php

namespace Tests\Unit\Http;

use Centum\Http\RequestFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class RequestFactoryCest
{
    public function testCreateFromGlobals(UnitTester $I): void
    {
        $requestFactory = new RequestFactory();



        $_GET["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "GET";

        $request = $requestFactory->createFromGlobals();

        $I->assertEquals(
            "bar",
            $request->getData()->get("foo"),
            "::fromGlobals() uses values from GET"
        );

        unset($_GET["foo1"]);



        $_POST["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "POST";

        $request = $requestFactory->createFromGlobals();

        $I->assertEquals(
            "bar",
            $request->getData()->get("foo"),
            "::fromGlobals() uses values from POST"
        );

        unset($_POST["foo1"]);
    }

    public function testCreateFromBrowserKitRequest(UnitTester $I): void
    {
        $uri = "/path/to/something";

        $method = "GET";

        $data = [
            "username" => "SidRoberts",
            "password" => "hunter2",
        ];

        //TODO
        $files = [];

        $cookies = [
            "language" => "en",
        ];

        $headers = [
            "HTTP_USER_AGENT" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
        ];

        $content = "some content";

        $browserKitRequest = new BrowserKitRequest(
            $uri,
            $method,
            $data,
            $files,
            $cookies,
            $headers,
            $content
        );

        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            $uri,
            $request->getUri()
        );

        $I->assertEquals(
            $method,
            $request->getMethod()
        );

        $I->assertEquals(
            $data,
            $request->getData()->toArray()
        );

        $I->assertEquals(
            $browserKitRequest->getFiles(),
            $request->getFiles()->toArray()
        );

        $I->assertEquals(
            $cookies,
            $request->getCookies()->toArray()
        );

        $I->assertEquals(
            [
                "User-Agent" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            $request->getHeaders()->toArray()
        );

        $I->assertEquals(
            $content,
            $request->getContent()
        );
    }
}
