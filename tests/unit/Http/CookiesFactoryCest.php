<?php

namespace Tests\Http;

use Centum\Http\CookiesFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class CookiesFactoryCest
{
    public function createFromBrowserKitRequest(UnitTester $I)
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

        $cookies = CookiesFactory::createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            [
                "language" => "en",
            ],
            $cookies->toArray()
        );
    }
}
