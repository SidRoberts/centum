<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookiesInterface;
use Exception;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class CookiesFactory
{
    public function createFromGlobal(): CookiesInterface
    {
        /** @var array<non-empty-string, string> $_COOKIE */

        return $this->createFromArray($_COOKIE);
    }

    /**
     * @param array<non-empty-string, string> $array
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
            if ($key === "") {
                throw new Exception("Cookie must have a key.");
            }

            $cookie = new Cookie($key, $value);

            $cookies->add($cookie);
        }

        return $cookies;
    }
}
