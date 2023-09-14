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
        $cookies = [];

        foreach ($array as $key => $value) {
            $cookies[] = new Cookie($key, $value);
        }

        return new Cookies($cookies);
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): CookiesInterface
    {
        $cookies = [];

        /** @var array<string, string> */
        $browserKitCookies = $browserKitRequest->getCookies();

        foreach ($browserKitCookies as $key => $value) {
            if ($key === "") {
                throw new Exception("Cookie must have a key.");
            }

            $cookies[] = new Cookie($key, $value);
        }

        return new Cookies($cookies);
    }
}
