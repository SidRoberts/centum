<?php

namespace Centum\Http;

class RequestFactory
{
    public static function createFromGlobals() : Request
    {
        $uri    = $_SERVER["REQUEST_URI"] ?? "";
        $method = $_SERVER["REQUEST_METHOD"] ?? "GET";

        $content     = stream_get_contents(fopen("php://input", "r"));
        $contentType = $_SERVER["CONTENT_TYPE"] ?? "text/plain";

        if ($method === "GET") {
            $parameters = $_GET;
        } elseif ($method === "POST") {
            $parameters = $_POST;
        } elseif ($contentType === "application/x-www-form-urlencoded") {
            parse_str($content, $parameters);
        } else {
            $parameters = [];
        }

        $request = new Request($uri, $method, $parameters, $content);

        return $request;
    }
}
