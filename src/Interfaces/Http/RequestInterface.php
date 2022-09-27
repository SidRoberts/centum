<?php

namespace Centum\Interfaces\Http;

interface RequestInterface
{
    public function getUri(): string;

    public function getMethod(): string;

    public function getData(): DataInterface;

    public function getHeaders(): HeadersInterface;

    public function getCookies(): CookiesInterface;

    public function getFiles(): FilesInterface;

    public function getContent(): ?string;
}
