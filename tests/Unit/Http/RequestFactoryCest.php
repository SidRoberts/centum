<?php

namespace Tests\Unit\Http;

use Centum\Http\RequestFactory;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\RequestFactory
 */
final class RequestFactoryCest
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



    #[DataProvider("providerCreateFromArrays")]
    public function testCreateFromArrays(UnitTester $I, Example $example): void
    {
        /** @var string */
        $method = $example["method"];



        $server = [
            "REQUEST_METHOD" => $method,
        ];

        $get = [
            "origin" => "GET",
        ];

        $post = [
            "origin" => "POST",
        ];

        $content = "";



        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromArrays($server, $get, $post, $content);

        $I->assertEquals(
            $method,
            $request->getMethod()
        );

        $I->assertEquals(
            $method,
            $request->getData()->get("origin")
        );
    }

    /**
     * @return array<array{method: string}>
     */
    protected function providerCreateFromArrays(): array
    {
        return [
            [
                "method" => "GET",
            ],

            [
                "method" => "POST",
            ],
        ];
    }



    public function testCreateFromArraysOverwriteMethod(UnitTester $I): void
    {
        $server = [
            "REQUEST_METHOD" => "POST",
        ];

        $get = [];

        $post = [
            "_method" => "PATCH",
            "key1"    => "value1",
            "key2"    => "value2",
        ];

        $content = "";



        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromArrays($server, $get, $post, $content);

        $I->assertEquals(
            "PATCH",
            $request->getMethod()
        );

        $I->assertEquals(
            [
                "key1" => "value1",
                "key2" => "value2",
            ],
            $request->getData()->toArray()
        );
    }



    #[DataProvider("providerCreateFromArraysFormEncoded")]
    public function testCreateFromArraysFormEncoded(UnitTester $I, Example $example): void
    {
        $server = [
            "CONTENT_TYPE"   => "application/x-www-form-urlencoded",
            "REQUEST_METHOD" => "PATCH",
        ];

        $get = [];

        $post = [];

        /** @var string */
        $content = $example["content"];



        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromArrays($server, $get, $post, $content);

        /** @var array */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $request->getData()->toArray()
        );
    }

    /**
     * @return array<array{content: string, expected: array}>
     */
    protected function providerCreateFromArraysFormEncoded(): array
    {
        return [
            [
                "content"  => "first=value&arr[]=foo+bar&arr[]=baz",
                "expected" => [
                    "first" => "value",
                    "arr"   => [
                        "foo bar",
                        "baz",
                    ],
                ],
            ],

            [
                "content"  => "",
                "expected" => [],
            ],
        ];
    }



    #[DataProvider("providerCreateFromArraysJsonContent")]
    public function testCreateFromArraysJsonContent(UnitTester $I, Example $example): void
    {
        $server = [
            "CONTENT_TYPE"   => "application/json",
            "REQUEST_METHOD" => "PATCH",
        ];

        $get = [];

        $post = [];

        /** @var string */
        $content = $example["content"];



        $requestFactory = new RequestFactory();

        $request = $requestFactory->createFromArrays($server, $get, $post, $content);

        /** @var array */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $request->getData()->toArray()
        );
    }

    /**
     * @return array<array{content: string, expected: array}>
     */
    protected function providerCreateFromArraysJsonContent(): array
    {
        return [
            [
                "content"  => "{\"key1\":\"value1\",\"key2\":\"value2\"}",
                "expected" => [
                    "key1" => "value1",
                    "key2" => "value2",
                ],
            ],

            [
                "content"  => "",
                "expected" => [],
            ],
        ];
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
