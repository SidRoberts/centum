<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookiesInterface;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class CookiesFactory
{
    public function createFromGlobal(): CookiesInterface
    {
        /** @var array<string, string> $_COOKIE */

        return $this->createFromArray($_COOKIE);
    }

    /**
     * @param array<string, string> $array
     */
    public function createFromArray(array $array): CookiesInterface
    {
        $cookies = new Cookies();

        foreach ($array as $key => $value) {
            $cookie = new Cookie($key, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): CookiesInterface
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
