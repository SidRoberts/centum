<?php

namespace Centum\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Interfaces\Paginator\PageInterface;
use Centum\Paginator\Exception\InvalidItemsPerPageException;
use Centum\Paginator\Exception\InvalidMaxException;
use Centum\Paginator\Exception\InvalidPageNumberException;

class Page implements PageInterface
{
    protected readonly DataInterface $data;
    protected readonly int $pageNumber;
    protected readonly int $itemsPerPage;



    public function __construct(DataInterface $data, int $pageNumber, int $itemsPerPage = 10)
    {
        if ($pageNumber < 1) {
            throw new InvalidPageNumberException($pageNumber);
        }

        if ($itemsPerPage < 1) {
            throw new InvalidItemsPerPageException($itemsPerPage);
        }

        $this->data         = $data;
        $this->pageNumber   = $pageNumber;
        $this->itemsPerPage = $itemsPerPage;
    }



    public function getData(): DataInterface
    {
        $offset = $this->getStartOffset();

        return $this->data->slice($offset, $this->itemsPerPage);
    }

    public function getTotalItems(): int
    {
        return $this->data->getTotal();
    }

    public function getTotalPages(): int
    {
        return (int) ceil($this->getTotalItems() / $this->itemsPerPage);
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }



    public function getStartOffset(): int
    {
        return ($this->pageNumber - 1) * $this->itemsPerPage;
    }

    public function getEndOffset(): int
    {
        $potentialEndOffset = $this->getStartOffset() + $this->itemsPerPage - 1;

        $absoluteEnd = max($this->getTotalItems() - 1, 0);

        return min($potentialEndOffset, $absoluteEnd);
    }



    public function getPageNumbersBefore(int $max): array
    {
        if ($max < 0) {
            throw new InvalidMaxException($max);
        }

        $previousPageNumber = $this->getPreviousPageNumber();

        if (!$previousPageNumber) {
            return [];
        }

        $absoluteFirstPageNumber = 1;

        $assumedFirstPageNumber = $this->pageNumber - $max;

        $startPageNumber = max($absoluteFirstPageNumber, $assumedFirstPageNumber);

        return range($startPageNumber, $previousPageNumber);
    }

    public function getPageNumbersAfter(int $max): array
    {
        if ($max < 0) {
            throw new InvalidMaxException($max);
        }

        $nextPageNumber = $this->getNextPageNumber();

        if (!$nextPageNumber) {
            return [];
        }

        $assumedLastPageNumber = $this->pageNumber + $max;

        $absoluteLastPageNumber = $this->getTotalPages();

        $endPageNumber = min($assumedLastPageNumber, $absoluteLastPageNumber);

        return range($nextPageNumber, $endPageNumber);
    }



    public function getPreviousPageNumber(): ?int
    {
        if ($this->pageNumber === 1) {
            return null;
        }

        return $this->pageNumber - 1;
    }

    public function getNextPageNumber(): ?int
    {
        $lastPageNumber = $this->getTotalPages();

        if ($this->pageNumber === $lastPageNumber) {
            return null;
        }

        return $this->pageNumber + 1;
    }
}
