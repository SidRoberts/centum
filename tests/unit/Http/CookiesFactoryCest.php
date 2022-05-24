<?php

namespace Tests\Unit\Http;

use Centum\Http\CookiesFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class CookiesFactoryCest
{
    public function testCreateFromBrowserKitRequest(UnitTester $I)
    {
        $browserKitRequest = new BrowserKitRequest(
            "/path/to/something",
            "GET",
            [],
            [],
            [
                "language" => "en",
            ],
            [],
            null
        );

        $cookiesFactory = new CookiesFactory();

        $cookies = $cookiesFactory->createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            [
                "language" => "en",
            ],
            $cookies->toArray()
        );
    }

    public function testCreateFromArray(UnitTester $I)
    {
        $array = [
            "language" => "en",
            "colour"   => "orange",
            "currency" => "KRW",
        ];

        $cookiesFactory = new CookiesFactory();

        $cookies = $cookiesFactory->createFromArray($array);

        $I->assertEquals(
            $array,
            $cookies->toArray()
        );
    }
}
