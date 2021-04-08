<?php

namespace Centum\Http;

use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

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

    public static function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Cookies
    {
        $cookies = new Cookies();

        /**
         * @var array<string, string>
         */
        $browserKitCookies = $browserKitRequest->getCookies();

        foreach ($browserKitCookies as $key => $value) {
            $cookie = new Cookie($key, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }
}
