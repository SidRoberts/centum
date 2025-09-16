<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\CookiesInterface;
use Centum\Interfaces\Http\HeadersInterface;

class JsonResponse extends Response
{
    public function __construct(
        mixed $variable,
        Status $status = Status::OK,
        ?HeadersInterface $headers = null,
        ?CookiesInterface $cookies = null)
    {
        $content = json_encode(
            $variable,
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );

        $newHeaders = $this->replaceHeaders($headers);

        parent::__construct($content, $status, $newHeaders, $cookies);
    }



    protected function replaceHeaders(?HeadersInterface $headers = null): HeadersInterface
    {
        if ($headers === null) {
            $headers = new Headers();
        }

        $existingHeaders = $headers->all();

        $defaults = [
            "Content-Type" => new Header("Content-Type", "application/json"),
        ];

        $existingHeaders = array_merge($defaults, $existingHeaders);

        return new Headers(
            array_values($existingHeaders)
        );
    }
}
