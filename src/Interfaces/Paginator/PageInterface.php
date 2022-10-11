<?php

namespace Centum\Interfaces\Paginator;

interface PageInterface
{
    public function getData(): DataInterface;

    public function getTotalItems(): int;

    public function getTotalPages(): int;

    public function getPageNumber(): int;

    public function getItemsPerPage(): int;



    public function getStartOffset(): int;

    public function getEndOffset(): int;



    /**
     * @return array<int>
     */
    public function getPageNumbersBefore(int $max): array;

    /**
     * @return array<int>
     */
    public function getPageNumbersAfter(int $max): array;



    public function getPreviousPageNumber(): ?int;

    public function getNextPageNumber(): ?int;
}
