<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidPageNumberException extends InvalidArgumentException
{
    public function __construct(
        protected readonly int $pageNumber
    ) {
        parent::__construct("Page number must be a non-zero positive integer.");
    }



    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }
}
