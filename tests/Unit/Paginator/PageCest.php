<?php

namespace Tests\Unit\Paginator;

use Centum\Paginator\Data\ArrayData;
use Centum\Paginator\Exception\InvalidMaxException;
use Centum\Paginator\Exception\InvalidPageNumberException;
use Centum\Paginator\Page;
use Centum\Paginator\Paginator;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

class PageCest
{
    #[DataProvider("providerBadPageNumbers")]
    public function testBadPageNumbers(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        /** @var int */
        $pageNumber = $example[0];

        $I->expectThrowable(
            new InvalidPageNumberException($pageNumber),
            function () use ($paginator, $pageNumber) {
                new Page($paginator, $pageNumber);
            }
        );
    }

    protected function providerBadPageNumbers(): array
    {
        return [
            [0],
            [-1],
            [-123],
        ];
    }



    public function testGetPaginator(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        $pageNumber = 1;

        $page = new Page($paginator, $pageNumber);

        $I->assertSame(
            $paginator,
            $page->getPaginator()
        );
    }



    #[DataProvider("providerGetData")]
    public function testGetData(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 95)
        );

        $paginator = new Paginator($data, 10, "/items/");

        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($paginator, $pageNumber);

        /** @var array */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $page->getData()
        );
    }

    protected function providerGetData(): array
    {
        return [
            [
                "pageNumber" => 1,
                "expected"   => range(1, 10),
            ],

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



    #[DataProvider("providerGetPreviousPageNumber")]
    public function testGetPreviousPageNumber(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($paginator, $pageNumber);

        /** @var int|null */
        $expected = $example["expected"];

        $I->assertSame(
            $expected,
            $page->getPreviousPageNumber()
        );
    }

    protected function providerGetPreviousPageNumber(): array
    {
        return [
            [
                "pageNumber" => 1,
                "expected"   => null,
            ],

            [
                "pageNumber" => 2,
                "expected"   => 1,
            ],

            [
                "pageNumber" => 3,
                "expected"   => 2,
            ],
        ];
    }



    #[DataProvider("providerGetNextPageNumber")]
    public function testGetNextPageNumber(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($paginator, $pageNumber);

        /** @var int|null */
        $expected = $example["expected"];

        $I->assertSame(
            $expected,
            $page->getNextPageNumber()
        );
    }

    protected function providerGetNextPageNumber(): array
    {
        return [
            [
                "pageNumber" => 1,
                "expected"   => 2,
            ],

            [
                "pageNumber" => 2,
                "expected"   => 3,
            ],

            [
                "pageNumber" => 10,
                "expected"   => null,
            ],
        ];
    }



    #[DataProvider("providerGetPageRange")]
    public function testGetPageRange(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        /** @var int */
        $pageNumber = $example["pageNumber"];

        $page = new Page($paginator, $pageNumber);

        /** @var array */
        $expected = $example["expected"];

        /** @var int */
        $i = $example["i"];

        $I->assertSame(
            $expected,
            $page->getPageRange($i)
        );
    }

    protected function providerGetPageRange(): array
    {
        return [
            [
                "pageNumber" => 1,
                "expected"   => range(1, 4),
                "i"          => 3,
            ],

            [
                "pageNumber" => 4,
                "expected"   => range(1, 7),
                "i"          => 3,
            ],

            [
                "pageNumber" => 9,
                "expected"   => range(6, 10),
                "i"          => 3,
            ],

            [
                "pageNumber" => 3,
                "expected"   => range(2, 4),
                "i"          => 1,
            ],

            [
                "pageNumber" => 5,
                "expected"   => range(1, 10),
                "i"          => 100,
            ],

            [
                "pageNumber" => 10,
                "expected"   => range(7, 10),
                "i"          => 3,
            ],

            // Page number too high.
            [
                "pageNumber" => 11,
                "expected"   => range(7, 10),
                "i"          => 3,
            ],
        ];
    }



    #[DataProvider("providerGetPageRangeBad")]
    public function testGetPageRangeBad(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        $page = new Page($paginator, 5);

        /** @var int */
        $max = $example[0];

        $I->expectThrowable(
            new InvalidMaxException($max),
            function () use ($page, $max) {
                $page->getPageRange($max);
            }
        );
    }

    protected function providerGetPageRangeBad(): array
    {
        return [
            [0],
            [-1],
        ];
    }
}
