<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidPageNumberException extends InvalidArgumentException
{
    protected readonly int $pageNumber;



    public function __construct(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;

        parent::__construct("Page number must be a non-zero positive integer.");
    }



    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }
}
