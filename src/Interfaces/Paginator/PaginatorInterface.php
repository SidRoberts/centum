<?php

namespace Centum\Interfaces\Paginator;

interface PaginatorInterface
{
    public function getData(): DataInterface;

    /**
     * @param positive-int $pageNumber
     */
    public function getItemsPerPage(): int;

    public function getUrlPrefix(): string;



    /**
     * @return non-negative-int
     */
    public function getTotalItems(): int;

    /**
     * @return positive-int
     */
    public function getTotalPages(): int;



    /**
     * @param positive-int $pageNumber
     */
    public function getPage(int $pageNumber): PageInterface;
}
