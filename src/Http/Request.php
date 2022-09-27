<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\DataInterface;

class Request
{
    protected readonly string $uri;
    protected readonly string $method;
    protected readonly DataInterface $data;
    protected readonly Headers $headers;
    protected readonly CookiesInterface $cookies;
    protected readonly Files $files;
    protected readonly ?string $content;



    public function __construct(
        string $uri,
        string $method = "GET",
        DataInterface $data = null,
        Headers $headers = null,
        CookiesInterface $cookies = null,
        Files $files = null,
        string $content = null
    ) {
        $this->uri     = $uri;
        $this->method  = strtoupper($method);
        $this->data    = $data ?? new Data([]);
        $this->headers = $headers ?? new Headers();
        $this->cookies = $cookies ?? new Cookies();
        $this->files   = $files ?? new Files();
        $this->content = $content;
    }



    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getData(): DataInterface
    {
        return $this->data;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function getCookies(): CookiesInterface
    {
        return $this->cookies;
    }

    public function getFiles(): Files
    {
        return $this->files;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
