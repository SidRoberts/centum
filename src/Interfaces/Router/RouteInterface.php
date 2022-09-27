<?php

namespace Centum\Interfaces\Router;

use Centum\Interfaces\Filter\FilterInterface;

interface RouteInterface
{
    public function getHttpMethod(): string;

    public function getUri(): string;

    /**
     * @return class-string
     */
    public function getClass(): string;

    public function getMethod(): string;



    public function getUriPattern(): string;



    /**
     * @return array<string, FilterInterface>
     */
    public function getFilters(): array;

    public function addFilter(string $key, FilterInterface $filter): RouteInterface;
}
