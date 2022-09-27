<?php

namespace Centum\Http;

use Centum\Interfaces\Http\HeadersInterface;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class HeadersFactory
{
    public function createFromGlobal(): HeadersInterface
    {
        /** @var array<string, string> */
        $array = getallheaders();

        return $this->createFromArray($array);
    }

    /**
     * @param array<string, string> $array
     */
    public function createFromArray(array $array): HeadersInterface
    {
        $headers = new Headers();

        foreach ($array as $key => $value) {
            $header = new Header($key, $value);

            $headers->add($header);
        }

        return $headers;
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): HeadersInterface
    {
        $headers = new Headers();

        /** @var array<string, string> */
        $server = $browserKitRequest->getServer();

        $contentHeaders = ['Content-Length', 'Content-Md5', 'Content-Type'];

        foreach ($server as $key => $value) {
            $key = str_replace("_", "-", $key);
            $key = strtolower($key);
            $key = ucwords($key, "-");

            if (!in_array($key, $contentHeaders) && !str_starts_with($key, "Http-")) {
                continue;
            }

            if (str_starts_with($key, "Http-")) {
                $key = substr($key, 5);
            }

            $header = new Header($key, $value);

            $headers->add($header);
        }

        return $headers;
    }
}
