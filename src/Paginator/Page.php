<?php

namespace Centum\Paginator;

use Centum\Interfaces\Paginator\PageInterface;
use Centum\Interfaces\Paginator\PaginatorInterface;

class Page implements PageInterface
{
    /**
     * @param positive-int $pageNumber
     */
    public function __construct(
        protected readonly PaginatorInterface $paginator,
        protected readonly int $pageNumber
    ) {
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



    public function getPreviousPageNumber(): ?int
    {
        $previousPageNumber = $this->pageNumber - 1;

        if ($previousPageNumber < 1) {
            return null;
        }

        return $previousPageNumber;
    }

    public function getNextPageNumber(): ?int
    {
        $nextPageNumber = $this->pageNumber + 1;

        if ($nextPageNumber > $this->paginator->getTotalPages()) {
            return null;
        }

        return $nextPageNumber;
    }



    public function getPageRange(int $max): array
    {
        $pageNumber = $this->pageNumber;

        if ($pageNumber > $this->paginator->getTotalPages()) {
            $pageNumber = $this->paginator->getTotalPages();
        }

        $firstPaginationPageNumber = max($pageNumber - $max, 1);
        $lastPaginationPageNumber  = min($pageNumber + $max, $this->paginator->getTotalPages());

        /** @var list<positive-int> */
        return range($firstPaginationPageNumber, $lastPaginationPageNumber);
    }
}
