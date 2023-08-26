<?php

namespace Centum\Interfaces\Router;

interface RouteInterface
{
    public function getHttpMethod(): string;

    public function getUri(): string;

    /**
     * @return class-string<ControllerInterface>
     */
    public function getClass(): string;

    public function getMethod(): string;

    /**
     * @return array<string, string>
     */
    public function getParameters(): array;
}
