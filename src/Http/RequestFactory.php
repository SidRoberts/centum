<?php

namespace Centum\Http;

use Centum\Http\Exception\FailedToOpenInputStreamException;
use Centum\Http\Exception\UriParseException;
use Centum\Interfaces\Http\RequestInterface;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class RequestFactory
{
    public function createFromGlobals(): RequestInterface
    {
        $inputStream = fopen("php://input", "r");

        if ($inputStream === false) {
            throw new FailedToOpenInputStreamException();
        }

        $content = stream_get_contents($inputStream);

        return $this->createFromArrays($_SERVER, $_GET, $_POST, $content);
    }

    public function createFromArrays(array $server, array $get, array $post, string $content): RequestInterface
    {
        /** @var string */
        $uri = $server["REQUEST_URI"] ?? "";

        // Remove parameter string
        $uri = parse_url($uri, PHP_URL_PATH);

        if (!is_string($uri)) {
            throw new UriParseException();
        }

        /** @var string */
        $method = $server["REQUEST_METHOD"] ?? "GET";

        /** @var string */
        $contentType = $server["CONTENT_TYPE"] ?? "text/plain";

        $parameters = null;

        if ($method === "GET") {
            $parameters = $get;
        } elseif ($method === "POST") {
            $parameters = $post;
        } elseif ($contentType === "application/x-www-form-urlencoded") {
            parse_str($content, $parameters);
        } elseif ($contentType === "application/json") {
            /** @var mixed */
            $parameters = json_decode($content, true);
        }

        if (!is_array($parameters)) {
            $parameters = [];
        }

        if (isset($post["_method"])) {
            /** @var string */
            $method = $post["_method"];

            unset($parameters["_method"]);
        }

        $method = Method::from($method);

        /** @var array<non-empty-string, mixed> $parameters */
        $data = new Data($parameters);

        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();
        $filesFactory   = new FilesFactory();

        $headers = $headersFactory->createFromGlobal();
        $cookies = $cookiesFactory->createFromGlobal();
        $files   = $filesFactory->createFromGlobal();

        return new Request($uri, $method, $data, $headers, $cookies, $files, $content);
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): RequestInterface
    {
        $headersFactory = new HeadersFactory();
        $cookiesFactory = new CookiesFactory();
        $filesFactory   = new FilesFactory();

        $uri = $browserKitRequest->getUri();

        /** @var array<non-empty-string, mixed> */
        $parameters = $browserKitRequest->getParameters();

        $requestUri = parse_url($uri, PHP_URL_PATH);
        $method     = strtoupper($browserKitRequest->getMethod());
        $data       = new Data($parameters);
        $headers    = $headersFactory->createFromBrowserKitRequest($browserKitRequest);
        $cookies    = $cookiesFactory->createFromBrowserKitRequest($browserKitRequest);
        $files      = $filesFactory->createFromBrowserKitRequest($browserKitRequest);
        $content    = $browserKitRequest->getContent();

        $method = Method::from($method);

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
