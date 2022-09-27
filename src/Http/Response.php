<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookiesInterface;

class Response
{
    protected readonly string $content;
    protected readonly Status $status;
    protected readonly Headers $headers;
    protected readonly CookiesInterface $cookies;



    public function __construct(
        string $content = "",
        Status $status = Status::OK,
        Headers $headers = null,
        CookiesInterface $cookies = null
    ) {
        $this->content = $content;

        $this->status  = $status;
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

    public function getCookies(): CookiesInterface
    {
        return $this->cookies;
    }



    public function sendHeaders(): Response
    {
        if (headers_sent()) {
            return $this;
        }

        $this->headers->send();

        $this->cookies->send();

        $this->status->send();

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



    public function getRaw(): string
    {
        $output = $this->status->getHeaderString() . "\r\n";

        foreach ($this->headers->all() as $header) {
            $output .= $header->getHeaderString() . "\r\n";
        }

        foreach ($this->cookies->all() as $cookie) {
            $output .= $cookie->getHeaderString() . "\r\n";
        }

        $output .= "\r\n";

        $output .= $this->content;

        return $output;
    }

    public function __toString(): string
    {
        return $this->getRaw();
    }
}
