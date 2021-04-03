<?php

namespace Centum\Http;

class CookiesFactory
{
    public static function createFromGlobal(): Cookies
    {
        $cookies = new Cookies();

        /**
         * @var string $name
         * @var string $value
         */
        foreach ($_COOKIE as $name => $value) {
            $cookie = new Cookie($name, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }
}
