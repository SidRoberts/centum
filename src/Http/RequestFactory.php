<?php

namespace Centum\Http;

use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class RequestFactory
{
    public function createFromGlobals(): Request
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

        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();

        $headers = $headersFactory->createFromGlobal();
        $cookies = $cookiesFactory->createFromGlobal();

        return new Request($uri, $method, $parameters, $headers, $cookies, $content);
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Request
    {
        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();

        $uri         = $browserKitRequest->getUri();
        $requestUri  = \parse_url($uri, PHP_URL_PATH);
        $method      = \strtoupper($browserKitRequest->getMethod());
        $parameters  = $browserKitRequest->getParameters();
        $headers     = $headersFactory->createFromBrowserKitRequest($browserKitRequest);
        $cookies     = $cookiesFactory->createFromBrowserKitRequest($browserKitRequest);
        $content     = $browserKitRequest->getContent();

        return new Request(
            $requestUri,
            $method,
            $parameters,
            $headers,
            $cookies,
            $content
        );
    }
}
