<?php

namespace Tests\Unit\Http;

use Centum\Http\HeadersFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class HeadersFactoryCest
{
    public function createFromBrowserKitRequest(UnitTester $I)
    {
        $browserKitRequest = new BrowserKitRequest(
            "/login",
            "POST",
            [],
            [],
            [],
            [
                "HTTP_USER_AGENT" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            null
        );

        $headers = HeadersFactory::createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            [
                "User-Agent" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            $headers->toArray()
        );
    }

    public function createFromArray(UnitTester $I)
    {
        $array = [
            "Content-Type" => "text/html",
            "User-Agent"   => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
        ];

        $headers = HeadersFactory::createFromArray($array);

        $I->assertEquals(
            $array,
            $headers->toArray()
        );
    }
}
