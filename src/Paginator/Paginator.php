<?php

namespace Centum\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Interfaces\Paginator\PageInterface;
use Centum\Interfaces\Paginator\PaginatorInterface;

class Paginator implements PaginatorInterface
{
    /**
     * @param positive-int $itemsPerPage
     */
    public function __construct(
        protected readonly DataInterface $data,
        protected readonly int $itemsPerPage,
        protected readonly string $urlPrefix
    ) {
    }



    public function getData(): DataInterface
    {
        return $this->data;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getUrlPrefix(): string
    {
        return $this->urlPrefix;
    }



    public function getTotalItems(): int
    {
        return $this->data->getTotal();
    }

    public function getTotalPages(): int
    {
        $totalItems = $this->getTotalItems();

        if ($totalItems === 0) {
            return 1;
        }

        /** @var positive-int */
        return (int) ceil($totalItems / $this->itemsPerPage);
    }



    public function getPage(int $pageNumber): PageInterface
    {
        return new Page($this, $pageNumber);
    }
}
