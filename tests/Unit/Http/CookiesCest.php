<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Centum\Interfaces\Http\CookieInterface;
use Mockery\MockInterface;
use OutOfRangeException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Cookies
 */
class CookiesCest
{
    public function testConstructor(UnitTester $I): void
    {
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



        $I->assertEquals(
            [
                "username" => $cookie1,
                "language" => $cookie2,
                "timezone" => $cookie3,
            ],
            $cookies->all()
        );
    }



    public function testGet(UnitTester $I): void
    {
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



        $I->assertSame(
            $cookie1,
            $cookies->get("username")
        );

        $I->assertSame(
            $cookie2,
            $cookies->get("language")
        );

        $I->assertSame(
            $cookie3,
            $cookies->get("timezone")
        );

        $I->expectThrowable(
            OutOfRangeException::class,
            function () use ($cookies) {
                $cookies->get("doesnt-exist");
            }
        );
    }



    public function testHas(UnitTester $I): void
    {
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



        $I->assertTrue(
            $cookies->has("username")
        );

        $I->assertTrue(
            $cookies->has("language")
        );

        $I->assertTrue(
            $cookies->has("timezone")
        );

        $I->assertFalse(
            $cookies->has("doesnt-exist")
        );
    }



    public function testSend(UnitTester $I): void
    {
        $cookie1 = $I->mock(
            CookieInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("username");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $cookie2 = $I->mock(
            CookieInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("language");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $cookie3 = $I->mock(
            CookieInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("timezone");

                $mock->shouldReceive("send")
                    ->once();
            }
        );



        $cookies = new Cookies(
            [
                $cookie1,
                $cookie2,
                $cookie3,
            ]
        );

        $cookies->send();
    }

    public function testAll(UnitTester $I): void
    {
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



        $I->assertEquals(
            [
                "username" => $cookie1,
                "language" => $cookie2,
                "timezone" => $cookie3,
            ],
            $cookies->all()
        );
    }

    public function testToArray(UnitTester $I): void
    {
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



        $I->assertEquals(
            [
                "username" => "SidRoberts",
                "language" => "en",
                "timezone" => "Asia/Seoul",
            ],
            $cookies->toArray()
        );
    }
}
