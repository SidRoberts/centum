<?php

namespace Centum\Http;

use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class CookiesFactory
{
    public function createFromGlobal(): Cookies
    {
        /** @var array<string, string> $_COOKIE */

        return $this->createFromArray($_COOKIE);
    }

    /**
     * @param array<string, string> $array
     */
    public function createFromArray(array $array): Cookies
    {
        $cookies = new Cookies();

        foreach ($array as $key => $value) {
            $cookie = new Cookie($key, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Cookies
    {
        $cookies = new Cookies();

        /** @var array<string, string> */
        $browserKitCookies = $browserKitRequest->getCookies();

        foreach ($browserKitCookies as $key => $value) {
            $cookie = new Cookie($key, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }
}
