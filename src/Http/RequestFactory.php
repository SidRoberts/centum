<?php

namespace Centum\Http;

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
        } elseif ($contentType === "application/x-www-form-urlencoded") {
            parse_str($content, $parameters);
        } elseif ($contentType === "application/json") {
            $parameters = json_decode($content, true);
        } else {
            $parameters = [];
        }

        $headers = [];

        /**
         * @var string $name
         * @var string $value
         */
        foreach (getallheaders() as $name => $value) {
            $headers[] = new Header($name, $value);
        }

        $cookies = [];

        /**
         * @var string $name
         * @var string $value
         */
        foreach ($_COOKIE as $name => $value) {
            $cookies[] = new Cookie($name, $value);
        }

        $request = new Request($uri, $method, $parameters, $headers, $cookies, $content);

        return $request;
    }
}
