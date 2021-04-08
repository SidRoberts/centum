<?php

namespace Centum\Http;

use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class RequestFactory
{
    public static function createFromGlobals(): Request
    {
        /**
         * @var string
         */
        $uri = $_SERVER["REQUEST_URI"] ?? "";

        /**
         * @var string
         */
        $method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"] ?? "GET";

        $content = stream_get_contents(fopen("php://input", "r"));

        /**
         * @var string
         */
        $contentType = $_SERVER["CONTENT_TYPE"] ?? "text/plain";

        if ($method === "GET") {
            $parameters = $_GET;
        } elseif ($method === "POST") {
            $parameters = $_POST;
        } else {
            /**
             * @var mixed
             */
            $parameters = match ($contentType) {
                "application/x-www-form-urlencoded" => parse_str($content, $parameters),
                "application/json"                  => json_decode($content, true),
                default                             => [],
            };

            if (!is_array($parameters)) {
                $parameters = [];
            }
        }

        $headers = HeadersFactory::createFromGlobal();
        $cookies = CookiesFactory::createFromGlobal();

        $request = new Request($uri, $method, $parameters, $headers, $cookies, $content);

        return $request;
    }

    public static function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Request
    {
        $uri         = $browserKitRequest->getUri();
        $queryString = \parse_url($uri, PHP_URL_QUERY);
        $method      = \strtoupper($browserKitRequest->getMethod());
        $content     = $browserKitRequest->getContent();

        if ($method === "GET") {
            \parse_str($queryString, $parameters);
        } else {
            $parameters = $browserKitRequest->getParameters();
        }



        $requestUri = \parse_url($uri, PHP_URL_PATH);

        return new Request(
            $requestUri,
            $method,
            $parameters,
            HeadersFactory::createFromBrowserKitRequest($browserKitRequest),
            CookiesFactory::createFromBrowserKitRequest($browserKitRequest),
            $content
        );
    }
}
