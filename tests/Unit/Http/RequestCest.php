<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Http\Data;
use Centum\Http\File;
use Centum\Http\FileGroup;
use Centum\Http\Files;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Method;
use Centum\Http\Request;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Request
 */
class RequestCest
{
    public function testGetters(UnitTester $I): void
    {
        $data = new Data(
            [
                "username" => "sidroberts",
                "password" => "hunter2",
            ]
        );

        $headers = new Headers(
            [
                new Header("cache-control", "no-cache"),
            ]
        );

        $cookies = new Cookies(
            [
                new Cookie("timezone", "Asia/Seoul"),
            ]
        );



        $file = new File("certificate.key", "application/octet-stream", 1024, "/dev/null", 0);

        $fileGroup = new FileGroup("certificate");

        $fileGroup->add($file);

        $files = new Files();

        $files->add($fileGroup);



        $request = new Request(
            "/login",
            Method::POST,
            $data,
            $headers,
            $cookies,
            $files,
            "Hello world"
        );



        $I->assertEquals(
            "/login",
            $request->getUri()
        );

        $I->assertEquals(
            "POST",
            $request->getMethod()
        );

        $I->assertSame(
            $data,
            $request->getData()
        );

        $I->assertSame(
            $headers,
            $request->getHeaders()
        );

        $I->assertSame(
            $cookies,
            $request->getCookies()
        );

        $I->assertEquals(
            "Hello world",
            $request->getContent()
        );
    }
}
