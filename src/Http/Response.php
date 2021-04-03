<?php

namespace Centum\Http;

class Response
{
    protected string $content;
    protected Status $status;
    protected Headers $headers;
    protected Cookies $cookies;



    public function __construct(string $content = "", int $statusCode = 200, Headers $headers = null, Cookies $cookies = null)
    {
        $this->content = $content;

        $this->status  = new Status($statusCode);
        $this->headers = $headers ?? new Headers();
        $this->cookies = $cookies ?? new Cookies();
    }



    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function getCookies(): Cookies
    {
        return $this->cookies;
    }



    public function sendHeaders(): Response
    {
        if (headers_sent()) {
            return $this;
        }

        foreach ($this->headers->all() as $header) {
            header(
                sprintf(
                    "%s: %s",
                    $header->getName(),
                    $header->getValue()
                ),
                false
            );
        }

        foreach ($this->cookies->all() as $cookie) {
            header(
                sprintf(
                    "Set-Cookie: %s: %s",
                    $cookie->getName(),
                    $cookie->getValue()
                ),
                false
            );
        }

        header(
            sprintf(
                "HTTP/1.0 %s %s",
                $this->status->getCode(),
                $this->status->getText()
            ),
            true,
            $this->status->getCode()
        );

        return $this;
    }

    public function sendContent(): Response
    {
        echo $this->content;

        return $this;
    }

    public function send(): Response
    {
        $this->sendHeaders();
        $this->sendContent();

        return $this;
    }
}
