<?php

namespace Centum\Interfaces\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Paginator\Page;

interface PaginatorInterface
{
    public function getData(): DataInterface;

    public function getTotalItems(): int;

    public function getItemsPerPage(): int;

    public function getTotalPages(): int;

    public function getPage(int $pageNumber): Page;
}
