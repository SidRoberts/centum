<?php

namespace Centum\Interfaces\Paginator;

interface PageInterface
{
    public function getPaginator(): PaginatorInterface;

    public function getPageNumber(): int;

    /**
     * @return array<mixed>
     */
    public function getData(): array;



    public function getPreviousPageNumber(): int|null;

    public function getNextPageNumber(): int|null;



    /**
     * @return list<int>
     */
    public function getPageRange(int $max): array;
}
