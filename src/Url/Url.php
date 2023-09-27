<?php

namespace Centum\Url;

use Centum\Interfaces\Url\UrlInterface;

class Url implements UrlInterface
{
    public function __construct(
        protected readonly string $baseUri = ""
    ) {
    }



    public function getBaseUri(): string
    {
        return $this->baseUri;
    }



    public function get(string $uri = "", array $arguments = []): string
    {
        $uri = rtrim($this->baseUri, "/") . "/" . ltrim($uri, "/");

        $queryString = http_build_query($arguments);

        if (mb_strlen($queryString) > 0) {
            if (str_contains($uri, "?")) {
                $uri .= "&" . $queryString;
            } else {
                $uri .= "?" . $queryString;
            }
        }

        return $uri;
    }
}
