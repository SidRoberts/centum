<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Mockery;
use Mockery\MockInterface;
use Tests\UnitTester;

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



    public function testAdd(UnitTester $I): void
    {
        $cookie1 = new Cookie("username", "SidRoberts");
        $cookie2 = new Cookie("language", "en");
        $cookie3 = new Cookie("timezone", "Asia/Seoul");



        $cookies = new Cookies();

        $cookies->add($cookie1);
        $cookies->add($cookie2);
        $cookies->add($cookie3);



        $I->assertEquals(
            [
                "username" => $cookie1,
                "language" => $cookie2,
                "timezone" => $cookie3,
            ],
            $cookies->all()
        );
    }



    public function testSend(UnitTester $I): void
    {
        $cookie1 = Mockery::mock(
            Cookie::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("username");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $cookie2 = Mockery::mock(
            Cookie::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("language");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $cookie3 = Mockery::mock(
            Cookie::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("timezone");

                $mock->shouldReceive("send")
                    ->once();
            }
        );



        $cookies = new Cookies();

        $cookies->add($cookie1);
        $cookies->add($cookie2);
        $cookies->add($cookie3);

        $cookies->send();
    }

    public function testAll(UnitTester $I): void
    {
        $cookie1 = new Cookie("username", "SidRoberts");
        $cookie2 = new Cookie("language", "en");
        $cookie3 = new Cookie("timezone", "Asia/Seoul");



        $cookies = new Cookies();

        $cookies->add($cookie1);
        $cookies->add($cookie2);
        $cookies->add($cookie3);



        $I->assertEquals(
            [
                "username" => $cookie1,
                "language" => $cookie2,
                "timezone" => $cookie3,
            ],
            $cookies->all()
        );
    }
}
