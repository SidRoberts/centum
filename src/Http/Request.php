<?php

namespace Centum\Http;

class Request
{
    protected readonly string $uri;
    protected readonly string $method;
    protected readonly Data $data;
    protected readonly Headers $headers;
    protected readonly Cookies $cookies;
    protected readonly Files $files;
    protected readonly ?string $content;



    public function __construct(
        string $uri,
        string $method = "GET",
        Data $data = null,
        Headers $headers = null,
        Cookies $cookies = null,
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

    public function getData(): Data
    {
        return $this->data;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function getCookies(): Cookies
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
