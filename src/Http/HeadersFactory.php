<?php

namespace Centum\Http;

use Centum\Http\Exception\HeaderKeyEmptyException;
use Centum\Interfaces\Http\HeadersInterface;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class HeadersFactory
{
    public function createFromGlobal(): HeadersInterface
    {
        /** @var array<non-empty-string, string> */
        $array = getallheaders();

        return $this->createFromArray($array);
    }

    /**
     * @param array<non-empty-string, string> $array
     */
    public function createFromArray(array $array): HeadersInterface
    {
        $headers = [];

        foreach ($array as $key => $value) {
            $headers[] = new Header($key, $value);
        }

        return new Headers($headers);
    }

    /**
     * @throws HeaderKeyEmptyException
     */
    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): HeadersInterface
    {
        $headers = [];

        /** @var array<string, string> */
        $server = $browserKitRequest->getServer();

        $contentHeaders = ["Content-Length", "Content-Md5", "Content-Type"];

        foreach ($server as $key => $value) {
            $key = str_replace("_", "-", $key);
            $key = mb_strtolower($key);
            $key = ucwords($key, "-");

            if (!in_array($key, $contentHeaders, true) && !str_starts_with($key, "Http-")) {
                continue;
            }

            if (str_starts_with($key, "Http-")) {
                $key = mb_substr($key, 5);
            }

            if ($key === "") {
                throw new HeaderKeyEmptyException();
            }

            $headers[] = new Header($key, $value);
        }

        return new Headers($headers);
    }
}
