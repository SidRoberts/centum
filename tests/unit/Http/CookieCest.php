<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Tests\UnitTester;

class CookieCest
{
    public function testGetters(UnitTester $I)
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

    public function testGetHeaderString(UnitTester $I)
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "Set-Cookie: logged_in: yes",
            $cookie->getHeaderString()
        );
    }

    public function testToString(UnitTester $I)
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "logged_in: yes\r\n",
            (string) $cookie
        );
    }
}
