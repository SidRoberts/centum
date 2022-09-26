<?php

namespace Centum\Interfaces\Url;

interface UrlInterface
{
    public function getBaseUri(): string;



    public function get(string $uri = "", array $arguments = []): string;
}
