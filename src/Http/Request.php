<?php

namespace Centum\Http;

class Request
{
    protected string $uri;
    protected string $method;
    protected array $data;
    protected Headers $headers;
    protected Cookies $cookies;
    protected ?string $content;



    public function __construct(
        string $uri,
        string $method = "GET",
        array $data = [],
        Headers $headers = null,
        Cookies $cookies = null,
        string $content = null
    ) {
        $this->uri     = $uri;
        $this->method  = strtoupper($method);
        $this->data    = $data;
        $this->headers = $headers ?? new Headers();
        $this->cookies = $cookies ?? new Cookies();
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

    public function getData(): array
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

    public function getContent(): ?string
    {
        return $this->content;
    }
}
