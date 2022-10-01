<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Request;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

trait AjaxActions
{
    abstract public function handleRequest(RequestInterface $request): ResponseInterface;



    /**
     * @param array<string, mixed> $data
     */
    public function sendAjaxRequest(string $method, string $uri, array $data = []): void
    {
        $data = new Data($data);

        $headers = new Headers(
            [
                new Header("X-Requested-With", "XMLHttpRequest"),
            ]
        );

        $request = new Request($uri, $method, $data, $headers);

        $this->handleRequest($request);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function sendAjaxGetRequest(string $uri, array $data = []): void
    {
        $this->sendAjaxRequest("GET", $uri, $data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function sendAjaxPostRequest(string $uri, array $data = []): void
    {
        $this->sendAjaxRequest("POST", $uri, $data);
    }
}
