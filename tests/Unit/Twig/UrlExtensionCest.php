<?php

namespace Tests\Unit\Twig;

use Centum\Twig\UrlExtension;
use Centum\Url\Url;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;
use Twig\Loader\ArrayLoader;

class UrlExtensionCest
{
    #[DataProvider("provider")]
    public function test(UnitTester $I, Example $example): void
    {
        /** @var string */
        $baseUri = $example["baseUri"];

        $url = new Url($baseUri);



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

    protected function provider(): array
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
