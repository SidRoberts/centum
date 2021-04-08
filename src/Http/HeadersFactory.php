<?php

namespace Centum\Http;

use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class HeadersFactory
{
    public static function createFromGlobal(): Headers
    {
        $headers = new Headers();

        /**
         * @var string $name
         * @var string $value
         */
        foreach (getallheaders() as $name => $value) {
            $header = new Header($name, $value);

            $headers->add($header);
        }

        return $headers;
    }

    public static function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Headers
    {
        $headers = new Headers();

        /**
         * @var array<string, string>
         */
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
