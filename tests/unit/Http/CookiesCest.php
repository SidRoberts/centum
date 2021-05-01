<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Http\Cookies;
use Mockery;
use Tests\UnitTester;

class CookiesCest
{
    public function send(UnitTester $I): void
    {
        $cookie1 = Mockery::mock(Cookie::class);

        $cookie1->expects()
            ->getName()
            ->andReturn("username");

        $cookie1->expects()
            ->send()
            ->once();



        $cookie2 = Mockery::mock(Cookie::class);

        $cookie2->expects()
            ->getName()
            ->andReturn("language");

        $cookie2->expects()
            ->send()
            ->once();



        $cookie3 = Mockery::mock(Cookie::class);

        $cookie3->expects()
            ->getName()
            ->andReturn("timezone");

        $cookie3->expects()
            ->send()
            ->once();



        $cookies = new Cookies();

        $cookies->add($cookie1);
        $cookies->add($cookie2);
        $cookies->add($cookie3);

        $cookies->send();
    }

    public function all(UnitTester $I): void
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
