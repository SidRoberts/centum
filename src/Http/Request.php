<?php

namespace Centum\Http;

class Request
{
    protected string $uri;
    protected string $method;
    protected array $parameters;
    protected Headers $headers;
    protected Cookies $cookies;
    protected ?string $content;



    public function __construct(
        string $uri,
        string $method = "GET",
        array $parameters = [],
        Headers $headers = null,
        Cookies $cookies = null,
        string $content = null
    ) {
        $this->uri        = $uri;
        $this->method     = strtoupper($method);
        $this->parameters = $parameters;
        $this->headers    = $headers ?? new Headers();
        $this->cookies    = $cookies ?? new Cookies();
        $this->content    = $content;
    }



    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameters(): array
    {
        return $this->parameters;
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
