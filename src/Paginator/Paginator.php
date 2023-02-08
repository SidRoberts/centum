<?php

namespace Centum\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Interfaces\Paginator\PageInterface;
use Centum\Interfaces\Paginator\PaginatorInterface;
use Centum\Paginator\Exception\InvalidItemsPerPageException;

class Paginator implements PaginatorInterface
{
    protected readonly DataInterface $data;
    protected readonly int $itemsPerPage;
    protected readonly string $urlPrefix;



    public function __construct(DataInterface $data, int $itemsPerPage, string $urlPrefix)
    {
        if ($itemsPerPage < 1) {
            throw new InvalidItemsPerPageException($itemsPerPage);
        }

        $this->data         = $data;
        $this->itemsPerPage = $itemsPerPage;
        $this->urlPrefix    = $urlPrefix;
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
        if ($this->getTotalItems() === 0) {
            return 1;
        }

        return (int) ceil($this->getTotalItems() / $this->itemsPerPage);
    }



    public function getPage(int $pageNumber): PageInterface
    {
        return new Page($this, $pageNumber);
    }
}
