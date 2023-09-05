<?php

namespace Centum\Interfaces\Router;

interface RouteInterface
{
    /**
     * @return non-empty-string
     */
    public function getHttpMethod(): string;

    public function getUri(): string;

    /**
     * @return class-string<ControllerInterface>
     */
    public function getClass(): string;

    /**
     * @return non-empty-string
     */
    public function getMethod(): string;

    /**
     * @return array<non-empty-string, string>
     */
    public function getParameters(): array;
}
