<?php

namespace Centum\Paginator;

use Centum\Paginator\Exception\InvalidItemsPerPageException;
use Centum\Paginator\Page;

class Paginator
{
    protected readonly DataInterface $data;
    protected readonly int $itemsPerPage;



    public function __construct(DataInterface $data, int $itemsPerPage = 10)
    {
        if ($itemsPerPage < 1) {
            throw new InvalidItemsPerPageException($itemsPerPage);
        }

        $this->data         = $data;
        $this->itemsPerPage = $itemsPerPage;
    }



    public function getData(): DataInterface
    {
        return $this->data;
    }

    public function getTotalItems(): int
    {
        return $this->data->getTotal();
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getTotalPages(): int
    {
        return (int) ceil($this->getTotalItems() / $this->itemsPerPage);
    }

    public function getPage(int $pageNumber): Page
    {
        return new Page($this->data, $pageNumber, $this->itemsPerPage);
    }
}
