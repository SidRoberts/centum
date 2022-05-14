<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Tests\UnitTester;

class ResponseCest
{
    public function getters(UnitTester $I)
    {
        $headers = new Headers();

        $headers->add(
            new Header("cache-control", "no-cache")
        );



        $cookies = new Cookies();

        $cookies->add(
            new Cookie("timezone", "Asia/Seoul")
        );



        $response = new Response(
            "Page cannot be found",
            Status::NOT_FOUND,
            $headers,
            $cookies
        );

        $I->assertEquals(
            "Page cannot be found",
            $response->getContent()
        );

        $I->assertEquals(
            Status::NOT_FOUND,
            $response->getStatus()
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

    public function sendContent(UnitTester $I): void
    {
        $I->expectEcho(
            "Hello world",
            function () {
                $response = new Response("Hello world");

                $response->sendContent();
            }
        );
    }
}
