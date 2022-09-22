<?php

namespace Tests\Unit\Paginator;

use Centum\Paginator\Data\ArrayData;
use Centum\Paginator\Page;
use Centum\Paginator\Paginator;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;
use Throwable;

class PaginatorCest
{
    public function testGetData(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 10),
            10
        );

        $paginator = new Paginator($data, 10);

        $I->assertSame(
            $data,
            $paginator->getData()
        );
    }



    public function testGetTotalItems(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100),
            100
        );

        $paginator = new Paginator($data, 10);

        $I->assertEquals(
            100,
            $paginator->getTotalItems()
        );
    }



    public function testGetItemsPerPageDefault(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100),
            100
        );

        $paginator = new Paginator($data);

        $I->assertEquals(
            10,
            $paginator->getItemsPerPage()
        );
    }



    #[DataProvider("providerGetItemsPerPageExceptions")]
    public function testGetItemsPerPageExceptions(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100),
            100
        );

        /** @var int */
        $itemsPerPage = $example[0];

        $I->expectThrowable(
            Throwable::class,
            function () use ($data, $itemsPerPage) {
                new Paginator($data, $itemsPerPage);
            }
        );
    }

    protected function providerGetItemsPerPageExceptions(): array
    {
        return [
            [-1],
            [0],
        ];
    }



    #[DataProvider("providerGetItemsPerPage")]
    public function testGetItemsPerPage(UnitTester $I, Example $example): void
    {
        $data = new ArrayData(
            range(1, 100),
            100
        );

        /** @var int */
        $itemsPerPage = $example[0];

        $paginator = new Paginator($data, $itemsPerPage);

        $I->assertEquals(
            $itemsPerPage,
            $paginator->getItemsPerPage()
        );
    }

    protected function providerGetItemsPerPage(): array
    {
        return [
            [10],
            [20],
        ];
    }



    public function getTotalPages(UnitTester $I): void
    {
        $totalItems = 95;
        $itemsPerPage = 10;

        $data = new ArrayData(
            range(1, 95),
            $totalItems
        );

        $paginator = new Paginator($data, $itemsPerPage);

        $I->assertEquals(
            10,
            $paginator->getTotalPages()
        );
    }



    public function testGetPage(UnitTester $I): void
    {
        $totalItems = 100;
        $itemsPerPage = 10;

        $data = new ArrayData(
            range(1, 100),
            $totalItems
        );

        $paginator = new Paginator($data, $itemsPerPage);

        $page = $paginator->getPage(3);

        $I->assertInstanceOf(
            Page::class,
            $page
        );

        $I->assertEquals(
            range(21, 30),
            $page->getData()->toArray()
        );

        $I->assertEquals(
            3,
            $page->getPageNumber()
        );

        $I->assertEquals(
            $totalItems,
            $page->getTotalItems()
        );

        $I->assertEquals(
            $itemsPerPage,
            $page->getItemsPerPage()
        );
    }



    public function testEmptyData(UnitTester $I): void
    {
        $totalItems = 0;
        $itemsPerPage = 10;

        $data = new ArrayData(
            [],
            0
        );

        $paginator = new Paginator($data, $itemsPerPage);

        $page = $paginator->getPage(1);

        $I->assertInstanceOf(
            Page::class,
            $page
        );

        $I->assertEquals(
            [],
            $page->getData()->toArray()
        );

        $I->assertEquals(
            1,
            $page->getPageNumber()
        );

        $I->assertEquals(
            $totalItems,
            $page->getTotalItems()
        );

        $I->assertEquals(
            $itemsPerPage,
            $page->getItemsPerPage()
        );
    }
}
