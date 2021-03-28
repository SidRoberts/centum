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
        } elseif ($contentType === "application/json") {
            $parameters = json_decode($content);
        } else {
            $parameters = [];
        }

        $headers = [];

        foreach (getallheaders() as $name => $value) {
            $headers[] = new Header($name, $value);
        }

        $cookies = [];

        foreach ($_COOKIE as $name => $value) {
            $cookies[] = new Cookie($name, $value);
        }

        $request = new Request($uri, $method, $parameters, $headers, $cookies, $content);

        return $request;
    }
}
