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
}
