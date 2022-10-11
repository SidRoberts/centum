<?php

namespace Centum\Url;

use Centum\Interfaces\Url\UrlInterface;

class Url implements UrlInterface
{
    protected readonly string $baseUri;



    public function __construct(string $baseUri = "")
    {
        $this->baseUri = $baseUri;
    }



    public function getBaseUri(): string
    {
        return $this->baseUri;
    }



    /**
     * @param array<mixed> $arguments
     */
    public function get(string $uri = "", array $arguments = []): string
    {
        $uri = rtrim($this->baseUri, "/") . "/" . ltrim($uri, "/");

        $queryString = http_build_query($arguments);

        if (strlen($queryString) > 0) {
            if (str_contains($uri, "?")) {
                $uri .= "&" . $queryString;
            } else {
                $uri .= "?" . $queryString;
            }
        }

        return $uri;
    }
}
