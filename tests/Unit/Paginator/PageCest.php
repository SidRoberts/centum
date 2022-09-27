<?php

namespace Tests\Unit\Paginator;

use Centum\Interfaces\Paginator\DataInterface;
use Centum\Paginator\Data\ArrayData;
use Centum\Paginator\Exception\InvalidItemsPerPageException;
use Centum\Paginator\Exception\InvalidMaxException;
use Centum\Paginator\Exception\InvalidPageNumberException;
use Centum\Paginator\Page;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class PageCest
{
    protected DataInterface $data;



    public function _before(UnitTester $I): void
    {
        $this->data = new ArrayData(
            range(1, 95),
            95
        );
    }



    #[DataProvider("providerGetData")]
    public function testGetData(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        $I->assertEquals(
            $example["expected"],
            $page->getData()->toArray()
        );
    }

    protected function providerGetData(): array
    {
        return [
            [
                "pageNumber" => 3,
                "expected"   => range(21, 30),
            ],

            [
                "pageNumber" => 10,
                "expected"   => range(91, 95),
            ],

            [
                "pageNumber" => 11,
                "expected"   => [],
            ],
        ];
    }



    #[DataProvider("providerOffset")]
    public function testOffset(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        /** @var int */
        $start = $example["start"];

        $I->assertEquals(
            $start,
            $page->getStartOffset()
        );

        /** @var int */
        $end = $example["end"];

        $I->assertEquals(
            $end,
            $page->getEndOffset()
        );
    }
    
    protected function providerOffset(): array
    {
        return [
            [
                "pageNumber" => 1,
                "start"      => 0,
                "end"        => 9,
            ],

            [
                "pageNumber" => 10,
                "start"      => 90,
                "end"        => 94,
            ],
        ];
    }



    #[DataProvider("providerBadPageNumbers")]
    public function testBadPageNumbers(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 10),
            10
        );

        /** @var int */
        $pageNumber = $example[0];

        $I->expectThrowable(
            new InvalidPageNumberException($pageNumber),
            function () use ($data, $pageNumber): void {
                new Page($data, $pageNumber);
            }
        );
    }

    protected function providerBadPageNumbers(): array
    {
        return [
            [-1],
            [0],
        ];
    }



    #[DataProvider("providerBadItemsPerPage")]
    public function testBadItemsPerPage(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 10),
            10
        );

        /** @var int */
        $itemsPerPage = $example[0];

        $I->expectThrowable(
            new InvalidItemsPerPageException($itemsPerPage),
            function () use ($data, $itemsPerPage): void {
                new Page($data, 1, $itemsPerPage);
            }
        );
    }

    protected function providerBadItemsPerPage(): array
    {
        return [
            [-1],
            [0],
        ];
    }



    #[DataProvider("providerPageNumbersBefore")]
    public function testPageNumbersBefore(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        /** @var array */
        $expected = $example["expected"];

        /** @var int */
        $max = $example["max"];

        $I->assertEquals(
            $expected,
            $page->getPageNumbersBefore($max)
        );
    }

    protected function providerPageNumbersBefore(): array
    {
        return [
            [
                "pageNumber" => 1,
                "max"        => 2,
                "expected"   => [],
            ],

            [
                "pageNumber" => 2,
                "max"        => 2,
                "expected"   => [1],
            ],

            [
                "pageNumber" => 10,
                "max"        => 2,
                "expected"   => [8, 9],
            ],
        ];
    }



    #[DataProvider("providerBadPageNumbersBefore")]
    public function testBadPageNumbersBefore(UnitTester $I, Example $example): void
    {
        $page = new Page($this->data, 3, 10);

        /** @var int */
        $max = $example[0];

        $I->expectThrowable(
            new InvalidMaxException($max),
            function () use ($page, $max): void {
                $page->getPageNumbersBefore($max);
            }
        );
    }

    protected function providerBadPageNumbersBefore(): array
    {
        return [
            [-1],
        ];
    }



    #[DataProvider("providerPageNumbersAfter")]
    public function testPageNumbersAfter(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        /** @var array */
        $expected = $example["expected"];

        /** @var int */
        $max = $example["max"];

        $I->assertEquals(
            $expected,
            $page->getPageNumbersAfter($max)
        );
    }

    protected function providerPageNumbersAfter(): array
    {
        return [
            [
                "pageNumber" => 5,
                "max"        => 2,
                "expected"   => [6, 7],
            ],

            [
                "pageNumber" => 9,
                "max"        => 2,
                "expected"   => [10],
            ],

            [
                "pageNumber" => 10,
                "max"        => 2,
                "expected"   => [],
            ],
        ];
    }



    #[DataProvider("providerBadPageNumbersAfter")]
    public function testBadPageNumbersAfter(UnitTester $I, Example $example): void
    {
        $page = new Page($this->data, 3, 10);

        /** @var int */
        $max = $example[0];

        $I->expectThrowable(
            new InvalidMaxException($max),
            function () use ($page, $max): void {
                $page->getPageNumbersAfter($max);
            }
        );
    }

    protected function providerBadPageNumbersAfter(): array
    {
        return [
            [-1],
        ];
    }



    #[DataProvider("providerGetPreviousPageNumber")]
    public function testGetPreviousPageNumber(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        $I->assertEquals(
            $example["previousPageNumber"],
            $page->getPreviousPageNumber()
        );
    }

    protected function providerGetPreviousPageNumber(): array
    {
        return [
            [
                "pageNumber"         => 1,
                "previousPageNumber" => null,
            ],

            [
                "pageNumber"         => 2,
                "previousPageNumber" => 1,
            ],
        ];
    }



    #[DataProvider("providerGetNextPageNumber")]
    public function testGetNextPageNumber(UnitTester $I, Example $example): void
    {
        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($this->data, $pageNumber, 10);

        $I->assertEquals(
            $example["nextPageNumber"],
            $page->getNextPageNumber()
        );
    }

    protected function providerGetNextPageNumber(): array
    {
        return [
            [
                "pageNumber"     => 9,
                "nextPageNumber" => 10,
            ],

            [
                "pageNumber"     => 10,
                "nextPageNumber" => null,
            ],
        ];
    }
}
