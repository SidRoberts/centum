<?php

namespace Tests\Unit\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response\HtmlResponse;
use Centum\Http\Status;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Response\HtmlResponse
 */
final class HtmlResponseCest
{
    public function testContentType(UnitTester $I): void
    {
        $response = new HtmlResponse(
            "<html>...</html>"
        );

        $I->assertTrue(
            $response->getHeaders()->matches("Content-Type", "text/html; charset=UTF-8")
        );
    }

    public function testStatus(UnitTester $I): void
    {
        $response = new HtmlResponse(
            "<html>...</html>"
        );

        $I->assertSame(
            Status::OK,
            $response->getStatus()
        );
    }

    public function testCustomStatus(UnitTester $I): void
    {
        $status = Status::INTERNAL_SERVER_ERROR;

        $response = new HtmlResponse(
            "<html>...</html>",
            $status
        );

        $I->assertSame(
            $status,
            $response->getStatus()
        );
    }

    public function testHeader(UnitTester $I): void
    {
        $headers = new Headers(
            [
                new Header("Access-Control-Allow-Origin", "*"),
            ]
        );

        $response = new HtmlResponse(
            "<html>...</html>",
            Status::OK,
            $headers
        );

        $responseHeaders = $response->getHeaders();

        $I->assertTrue(
            $responseHeaders->matches("Access-Control-Allow-Origin", "*")
        );

        $I->assertTrue(
            $responseHeaders->matches("Content-Type", "text/html; charset=UTF-8")
        );
    }

    public function testHeaderOverride(UnitTester $I): void
    {
        $headers = new Headers(
            [
                new Header("Access-Control-Allow-Origin", "*"),
                new Header("Content-Type", "application/xhtml+xml"),
            ]
        );

        $response = new HtmlResponse(
            "<html>...</html>",
            Status::OK,
            $headers
        );

        $responseHeaders = $response->getHeaders();

        $I->assertTrue(
            $responseHeaders->matches("Access-Control-Allow-Origin", "*")
        );

        $I->assertTrue(
            $responseHeaders->matches("Content-Type", "application/xhtml+xml")
        );
    }
}
