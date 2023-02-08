<?php

namespace Centum\Interfaces\Paginator;

interface PageInterface
{
    public function getPaginator(): PaginatorInterface;

    public function getPageNumber(): int;

    public function getData(): array;



    public function getPreviousPageNumber(): int|null;

    public function getNextPageNumber(): int|null;



    public function getPageRange(int $max): array;
}
