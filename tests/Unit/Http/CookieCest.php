<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Centum\Interfaces\Http\CookieInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Cookie
 */
final class CookieCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $cookie = $I->mock(Cookie::class);

        $I->assertInstanceOf(CookieInterface::class, $cookie);
    }



    public function testGetters(UnitTester $I): void
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "logged_in",
            $cookie->getName()
        );

        $I->assertEquals(
            "yes",
            $cookie->getValue()
        );
    }

    public function testGetHeaderString(UnitTester $I): void
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "Set-Cookie: logged_in: yes",
            $cookie->getHeaderString()
        );
    }

    public function testToString(UnitTester $I): void
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "logged_in: yes\r\n",
            (string) $cookie
        );
    }
}
