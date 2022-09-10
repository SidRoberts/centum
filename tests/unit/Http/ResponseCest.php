<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookies;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Tests\UnitTester;

class ResponseCest
{
    public function testGetters(UnitTester $I): void
    {
        $content = "Page cannot be found.";

        $status = Status::NOT_FOUND;

        $headers = new Headers();

        $cookies = new Cookies();



        $response = new Response(
            $content,
            $status,
            $headers,
            $cookies
        );

        $I->assertEquals(
            $content,
            $response->getContent()
        );

        $I->assertSame(
            $status,
            $response->getStatus()
        );

        $I->assertSame(
            $headers,
            $response->getHeaders()
        );

        $I->assertSame(
            $cookies,
            $response->getCookies()
        );
    }

    public function testSendContent(UnitTester $I): void
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
