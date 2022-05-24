<?php

namespace Tests\Unit\Http;

use Centum\Http\RequestFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class RequestFactoryCest
{
    public function testCreateFromGlobals(UnitTester $I)
    {
        $requestFactory = new RequestFactory();



        $_GET["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "GET";

        $request = $requestFactory->createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from GET");

        unset($_GET["foo1"]);



        $_POST["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "POST";

        $request = $requestFactory->createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from POST");

        unset($_POST["foo1"]);
    }

    public function testCreateFromBrowserKitRequest(UnitTester $I)
    {
        $browserKitRequest = new BrowserKitRequest(
            "/path/to/something",
            "GET",
            [
                "username" => "SidRoberts",
                "password" => "hunter2",
            ],
            [
                // $files
            ],
            [
                "language" => "en",
            ],
            [
                "HTTP_USER_AGENT" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            "some content"
        );

        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            "/path/to/something",
            $request->getUri()
        );

        $I->assertEquals(
            "GET",
            $request->getMethod()
        );

        $I->assertEquals(
            [
                "username" => "SidRoberts",
                "password" => "hunter2",
            ],
            $request->getParameters()
        );

        $I->assertEquals(
            [
                "language" => "en",
            ],
            $request->getCookies()->toArray()
        );

        $I->assertEquals(
            [
                "User-Agent" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            $request->getHeaders()->toArray()
        );

        $I->assertEquals(
            "some content",
            $request->getContent()
        );
    }
}
