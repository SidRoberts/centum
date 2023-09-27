<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response
 */
final class ResponseCest
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
        $content = "Hello world";

        $response = new Response($content);

        $I->expectEcho(
            $content,
            function () use ($response): void {
                $response->sendContent();
            }
        );
    }

    public function testSend(UnitTester $I): void
    {
        $response = $I->mock(
            Response::class,
            function (MockInterface $mock): void {
                $mock->makePartial();

                $mock->shouldReceive("sendHeaders")
                    ->andReturnSelf()
                    ->once();

                $mock->shouldReceive("sendContent")
                    ->andReturnSelf()
                    ->once();
            }
        );

        $response->send();
    }

    public function testGetRaw(UnitTester $I): void
    {
        $content = "This is the body.";

        $status = Status::OK;



        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");

        $headers = new Headers(
            [
                $header1,
                $header2,
                $header3,
            ]
        );



        $cookie1 = new Cookie("username", "SidRoberts");
        $cookie2 = new Cookie("language", "en");
        $cookie3 = new Cookie("timezone", "Asia/Seoul");

        $cookies = new Cookies(
            [
                $cookie1,
                $cookie2,
                $cookie3,
            ]
        );



        $response = new Response(
            $content,
            $status,
            $headers,
            $cookies
        );

        $expected  = "HTTP/1.0 200 OK\r\n";
        $expected .= "Content-Type: text/plain\r\n";
        $expected .= "Last-Modified: Sun, 04 Apr 2021 17:04:00 GMT\r\n";
        $expected .= "Content-Encoding: gzip\r\n";
        $expected .= "Set-Cookie: username: SidRoberts\r\n";
        $expected .= "Set-Cookie: language: en\r\n";
        $expected .= "Set-Cookie: timezone: Asia/Seoul\r\n";
        $expected .= "\r\n";
        $expected .= "This is the body.";

        $I->assertEquals(
            $expected,
            $response->getRaw()
        );
    }

    public function testToString(UnitTester $I): void
    {
        $content = "This is the body.";

        $status = Status::OK;



        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");

        $headers = new Headers(
            [
                $header1,
                $header2,
                $header3,
            ]
        );



        $cookie1 = new Cookie("username", "SidRoberts");
        $cookie2 = new Cookie("language", "en");
        $cookie3 = new Cookie("timezone", "Asia/Seoul");

        $cookies = new Cookies(
            [
                $cookie1,
                $cookie2,
                $cookie3,
            ]
        );



        $response = new Response(
            $content,
            $status,
            $headers,
            $cookies
        );

        $expected  = "HTTP/1.0 200 OK\r\n";
        $expected .= "Content-Type: text/plain\r\n";
        $expected .= "Last-Modified: Sun, 04 Apr 2021 17:04:00 GMT\r\n";
        $expected .= "Content-Encoding: gzip\r\n";
        $expected .= "Set-Cookie: username: SidRoberts\r\n";
        $expected .= "Set-Cookie: language: en\r\n";
        $expected .= "Set-Cookie: timezone: Asia/Seoul\r\n";
        $expected .= "\r\n";
        $expected .= "This is the body.";

        $I->assertEquals(
            $expected,
            (string) $response
        );
    }
}
