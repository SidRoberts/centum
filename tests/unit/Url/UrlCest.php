<?php

namespace Tests\Url;

use Tests\UnitTester;
use Centum\Url\Url;
use Codeception\Example;

class UrlCest
{
    public function getBaseUrl(UnitTester $I) : void
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
    public function url(UnitTester $I, Example $example) : void
    {
        $url = new Url(
            $example["baseUri"]
        );

        $actual = $url->get(
            $example["uri"]
        );



        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function providerUrl() : array
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
    public function arguments(UnitTester $I, Example $example) : void
    {
        $url = new Url();

        $actual = $url->get(
            $example["uri"],
            $example["arguments"]
        );



        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    public function providerArguments() : array
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
