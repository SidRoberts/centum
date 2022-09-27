<?php

namespace Centum\Interfaces\Http;

use Centum\Http\Status;

interface ResponseInterface
{
    public function getContent(): string;

    public function getStatus(): Status;

    public function getHeaders(): HeadersInterface;

    public function getCookies(): CookiesInterface;



    public function sendHeaders(): ResponseInterface;

    public function sendContent(): ResponseInterface;

    public function send(): ResponseInterface;



    public function getRaw(): string;

    public function __toString(): string;
}
