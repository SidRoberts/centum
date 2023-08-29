<?php

namespace Tests\Unit\Http;

use Centum\Http\HeadersFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\HeadersFactory
 */
class HeadersFactoryCest
{
    public function testCreateFromBrowserKitRequest(UnitTester $I): void
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

        $headersFactory = new HeadersFactory();

        $headers = $headersFactory->createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            [
                "User-Agent" => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
            ],
            $headers->toArray()
        );
    }

    public function testCreateFromArray(UnitTester $I): void
    {
        $array = [
            "Content-Type" => "text/html",
            "User-Agent"   => "Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586)",
        ];

        $headersFactory = new HeadersFactory();

        $headers = $headersFactory->createFromArray($array);

        $I->assertEquals(
            $array,
            $headers->toArray()
        );
    }
}
