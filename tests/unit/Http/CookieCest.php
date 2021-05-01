<?php

namespace Tests\Unit\Http;

use Centum\Http\Cookie;
use Tests\UnitTester;

class CookieCest
{
    public function getters(UnitTester $I)
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

    public function toString(UnitTester $I)
    {
        $cookie = new Cookie("logged_in", "yes");

        $I->assertEquals(
            "logged_in: yes\r\n",
            (string) $cookie
        );
    }
}
