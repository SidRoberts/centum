<?php

namespace Centum\Paginator\Exception;

use InvalidArgumentException;

class InvalidItemsPerPageException extends InvalidArgumentException
{
    protected int $itemsPerPage;



    public function __construct(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        parent::__construct("Items Per Page must be a non-zero positive integer.");
    }



    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
