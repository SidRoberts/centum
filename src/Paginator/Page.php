<?php

namespace Centum\Paginator;

use Centum\Interfaces\Paginator\PageInterface;
use Centum\Interfaces\Paginator\PaginatorInterface;
use Centum\Paginator\Exception\InvalidMaxException;
use Centum\Paginator\Exception\InvalidPageNumberException;

class Page implements PageInterface
{
    protected readonly PaginatorInterface $paginator;
    protected readonly int $pageNumber;



    public function __construct(PaginatorInterface $paginator, int $pageNumber)
    {
        if ($pageNumber < 1) {
            throw new InvalidPageNumberException($pageNumber);
        }

        $this->paginator  = $paginator;
        $this->pageNumber = $pageNumber;
    }



    public function getPaginator(): PaginatorInterface
    {
        return $this->paginator;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }



    public function getData(): array
    {
        $offset = ($this->pageNumber - 1) * $this->paginator->getItemsPerPage();

        return $this->paginator->getData()->slice(
            $offset,
            $this->paginator->getItemsPerPage()
        );
    }



    public function getPreviousPageNumber(): int|null
    {
        $previousPageNumber = $this->pageNumber - 1;

        if ($previousPageNumber < 1) {
            return null;
        }

        return $previousPageNumber;
    }

    public function getNextPageNumber(): int|null
    {
        $nextPageNumber = $this->pageNumber + 1;

        if ($nextPageNumber > $this->paginator->getTotalPages()) {
            return null;
        }

        return $nextPageNumber;
    }



    public function getPageRange(int $max): array
    {
        if ($max < 1) {
            throw new InvalidMaxException($max);
        }

        $pageNumber = $this->pageNumber;

        if ($pageNumber > $this->paginator->getTotalPages()) {
            $pageNumber = $this->paginator->getTotalPages();
        }

        $firstPaginationPageNumber = max($pageNumber - $max, 1);
        $lastPaginationPageNumber  = min($pageNumber + $max, $this->paginator->getTotalPages());

        return range($firstPaginationPageNumber, $lastPaginationPageNumber);
    }
}
