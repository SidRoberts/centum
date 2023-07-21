<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidItemsPerPageException extends InvalidArgumentException
{
    public function __construct(
        protected readonly int $itemsPerPage
    ) {
        parent::__construct("Items Per Page must be a non-zero positive integer.");
    }



    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
