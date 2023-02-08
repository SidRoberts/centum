<?php

namespace Centum\Interfaces\Paginator;

interface PaginatorInterface
{
    public function getData(): DataInterface;

    public function getItemsPerPage(): int;

    public function getUrlPrefix(): string;



    public function getTotalItems(): int;

    public function getTotalPages(): int;



    public function getPage(int $pageNumber): PageInterface;
}
