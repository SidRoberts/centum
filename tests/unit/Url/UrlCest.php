<?php

namespace Tests\Unit\Url;

use Centum\Url\Url;
use Codeception\Example;
use Tests\UnitTester;

class UrlCest
{
    public function testGetBaseUrl(UnitTester $I): void
    {
        $baseUri = "http://www.example.com";



        $url = new Url($baseUri);

        $I->assertEquals(
            $baseUri,
            $url->getBaseUri()
        );
    }

    /**
     * @dataProvider providerUrl
     */
    public function testUrl(UnitTester $I, Example $example): void
    {
        /** @var string */
        $baseUri = $example["baseUri"];

        $url = new Url($baseUri);

        /** @var string */
        $expected = $example["expected"];

        /** @var string */
        $uri = $example["uri"];

        $I->assertEquals(
            $expected,
            $url->get($uri)
        );
    }

    protected function providerUrl(): array
    {
        return [
            [
                "baseUri"  => "",
                "expected" => "/",
                "uri"      => "",
            ],

            [
                "baseUri"  => "",
                "expected" => "/",
                "uri"      => "/",
            ],

            [
                "baseUri"  => "",
                "expected" => "/this/is/the/path",
                "uri"      => "this/is/the/path",
            ],

            [
                "baseUri"  => "http://www.example.com",
                "expected" => "http://www.example.com/",
                "uri"      => "",
            ],

            [
                "baseUri"  => "http://www.example.com",
                "expected" => "http://www.example.com/",
                "uri"      => "/",
            ],

            [
                "baseUri"  => "http://www.example.com",
                "expected" => "http://www.example.com/this/is/the/path",
                "uri"      => "/this/is/the/path",
            ],
        ];
    }



    /**
     * @dataProvider providerArguments
     */
    public function testArguments(UnitTester $I, Example $example): void
    {
        $url = new Url();

        /** @var string */
        $uri = $example["uri"];

        /** @var array */
        $arguments = $example["arguments"];

        /** @var string */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $url->get($uri, $arguments)
        );
    }

    protected function providerArguments(): array
    {
        return [
            [
                "expected"  => "/some/path",
                "uri"       => "some/path",
                "arguments" => [],
            ],

            [
                "expected"  => "/some/path?title=hello+world",
                "uri"       => "some/path",
                "arguments" => [
                    "title" => "hello world",
                ],
            ],

            [
                "expected"  => "/some/path?title=hello+world&page=123",
                "uri"       => "some/path",
                "arguments" => [
                    "title" => "hello world",
                    "page"  => 123,
                ],
            ],

            [
                "expected"  => "/some/path?arguments=already&title=hello+world",
                "uri"       => "some/path?arguments=already",
                "arguments" => [
                    "title" => "hello world",
                ],
            ],

            [
                "expected"  => "/some/path?arguments=already&title=hello+world&page=123",
                "uri"       => "some/path?arguments=already",
                "arguments" => [
                    "title" => "hello world",
                    "page"  => 123,
                ],
            ],
        ];
    }
}
