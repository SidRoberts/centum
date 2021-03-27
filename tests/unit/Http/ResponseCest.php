<?php

namespace Tests\Http;

use Centum\Http\Cookie;
use Centum\Http\Header;
use Centum\Http\Response;
use Tests\UnitTester;

class ResponseCest
{
    public function getters(UnitTester $I)
    {
        $response = new Response(
            "Page cannot be found",
            404,
            [
                new Header("cache-control", "no-cache"),
            ],
            [
                new Cookie("timezone", "Asia/Seoul"),
            ]
        );

        $I->assertEquals(
            "Page cannot be found",
            $response->getContent()
        );

        $I->assertEquals(
            404,
            $response->getStatus()->getCode()
        );

        $I->assertEquals(
            [
                "cache-control" => "no-cache",
            ],
            $response->getHeaders()->toArray()
        );

        $I->assertEquals(
            [
                "timezone" => "Asia/Seoul",
            ],
            $response->getCookies()->toArray()
        );
    }
}
