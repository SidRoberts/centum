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

        // Remove parameter string
        $uri = parse_url($uri, PHP_URL_PATH);

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
            $data = $_GET;
        } elseif ($method === "POST") {
            $data = $_POST;
        } else {
            /**
             * @var mixed
             */
            $data = match ($contentType) {
                "application/x-www-form-urlencoded" => parse_str($content, $data),
                "application/json"                  => json_decode($content, true),
                default                             => [],
            };

            if (!is_array($data)) {
                $data = [];
            }
        }

        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();
        $filesFactory   = new FilesFactory();

        $headers = $headersFactory->createFromGlobal();
        $cookies = $cookiesFactory->createFromGlobal();
        $files   = $filesFactory->createFromGlobal();

        return new Request($uri, $method, $data, $headers, $cookies, $files, $content);
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): Request
    {
        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();
        $filesFactory   = new FilesFactory();

        $uri        = $browserKitRequest->getUri();
        $requestUri = \parse_url($uri, PHP_URL_PATH);
        $method     = \strtoupper($browserKitRequest->getMethod());
        $data       = $browserKitRequest->getParameters();
        $headers    = $headersFactory->createFromBrowserKitRequest($browserKitRequest);
        $cookies    = $cookiesFactory->createFromBrowserKitRequest($browserKitRequest);
        $files      = $filesFactory->createFromBrowserKitRequest($browserKitRequest);
        $content    = $browserKitRequest->getContent();

        return new Request(
            $requestUri,
            $method,
            $data,
            $headers,
            $cookies,
            $files,
            $content
        );
    }
}
