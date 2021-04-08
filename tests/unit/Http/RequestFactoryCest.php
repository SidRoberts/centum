<?php

namespace Tests\Http;

use Centum\Http\RequestFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class RequestFactoryCest
{
    public function testCreateFromGlobals(UnitTester $I)
    {
        $_GET["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "GET";

        $request = RequestFactory::createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from GET");

        unset($_GET["foo1"]);



        $_POST["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "POST";

        $request = RequestFactory::createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from POST");

        unset($_POST["foo1"]);
    }

    public function createFromBrowserKitRequest(UnitTester $I)
    {
        $browserKitRequest = new BrowserKitRequest(
            "/path/to/something",
            "GET",
            [
                "username" => "SidRoberts",
                "password" => "hunter2",
            ],
            $files = [],
            [
                "language" => "en",
            ],
            [
                "HTTP_USER_AGENT" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            "some content"
        );

        $request = RequestFactory::createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            $browserKitRequest->getUri(),
            $request->getUri()
        );

        $I->assertEquals(
            $browserKitRequest->getMethod(),
            $request->getMethod()
        );

        $I->assertEquals(
            $browserKitRequest->getCookies(),
            $request->getCookies()->toArray()
        );

        $I->assertEquals(
            [
                "User-Agent" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            $request->getHeaders()->toArray()
        );

        $I->assertEquals(
            $browserKitRequest->getContent(),
            $request->getContent()
        );
    }
}
