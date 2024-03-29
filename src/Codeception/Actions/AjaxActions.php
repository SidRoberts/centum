<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;

/**
 * Ajax Actions
 */
trait AjaxActions
{
    abstract public function handleRequest(RequestInterface $request): ResponseInterface;



    /**
     * @param array<non-empty-string, mixed> $data
     */
    public function createAjaxRequest(Method $method, string $uri, array $data = []): RequestInterface
    {
        $data = new Data($data);

        $headers = new Headers(
            [
                new Header("X-Requested-With", "XMLHttpRequest"),
            ]
        );

        $request = new Request($uri, $method, $data, $headers);

        return $request;
    }



    /**
     * @param array<non-empty-string, mixed> $data
     */
    public function sendAjaxRequest(Method $method, string $uri, array $data = []): void
    {
        $request = $this->createAjaxRequest($method, $uri, $data);

        $this->handleRequest($request);
    }

    /**
     * @param array<non-empty-string, mixed> $data
     */
    public function sendAjaxGetRequest(string $uri, array $data = []): void
    {
        $this->sendAjaxRequest(Method::GET, $uri, $data);
    }

    /**
     * @param array<non-empty-string, mixed> $data
     */
    public function sendAjaxPostRequest(string $uri, array $data = []): void
    {
        $this->sendAjaxRequest(Method::POST, $uri, $data);
    }
}
