<?php

namespace Centum\Interfaces\Url;

interface UrlInterface
{
    public function getBaseUri(): string;



    /**
     * @param array<mixed> $arguments
     */
    public function get(string $uri = "", array $arguments = []): string;
}
