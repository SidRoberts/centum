<?php

namespace Centum\Tests\Url\Twig;

use Codeception\Example;
use Centum\Tests\UnitTester;
use Centum\Url\Url;
use Centum\Url\Twig\UrlExtension;
use Twig\Loader\ArrayLoader;

class UrlExtensionCest
{
    /**
     * @dataProvider provider
     */
    public function extension(UnitTester $I, Example $example)
    {
        $url = new Url(
            $example["baseUri"]
        );



        $loader = new ArrayLoader(
            [
                "template" => "{{ url(url) }}",
            ]
        );

        $twig = new \Twig\Environment($loader);



        $twig->addExtension(
            new UrlExtension($url)
        );



        $actual = $twig->render(
            "template",
            [
                "url" => $example["uri"],
            ]
        );



        $I->assertEquals(
            $example["expected"],
            $actual
        );
    }

    protected function provider() : array
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
}
