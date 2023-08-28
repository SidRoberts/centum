<?php

namespace Centum\Interfaces\Paginator;

interface PageInterface
{
    public function getPaginator(): PaginatorInterface;

    /**
     * @return positive-int
     */
    public function getPageNumber(): int;

    /**
     * @return array<mixed>
     */
    public function getData(): array;



    /**
     * @return positive-int|null
     */
    public function getPreviousPageNumber(): int|null;

    /**
     * @return positive-int|null
     */
    public function getNextPageNumber(): int|null;



    /**
     * @param positive-int $max
     *
     * @return list<positive-int>
     */
    public function getPageRange(int $max): array;
}
