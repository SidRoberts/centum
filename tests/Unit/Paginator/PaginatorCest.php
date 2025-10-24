<?php

namespace Tests\Unit\Paginator;

use Centum\Interfaces\Paginator\PaginatorInterface;
use Centum\Paginator\Data\ArrayData;
use Centum\Paginator\Paginator;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Paginator\Paginator
 */
final class PaginatorCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $paginator = $I->mock(Paginator::class);

        $I->assertInstanceOf(PaginatorInterface::class, $paginator);
    }



    public function testGetData(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 10)
        );

        $paginator = new Paginator($data, 10, "/items/");

        $I->assertSame(
            $data,
            $paginator->getData()
        );
    }

    public function testGetItemsPerPage(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $itemsPerPage = 10;

        $paginator = new Paginator($data, $itemsPerPage, "/items/");

        $I->assertSame(
            $itemsPerPage,
            $paginator->getItemsPerPage()
        );
    }

    public function testGetUrlPrefix(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $urlPrefix = "/items/";

        $paginator = new Paginator($data, 10, $urlPrefix);

        $I->assertSame(
            $urlPrefix,
            $paginator->getUrlPrefix()
        );
    }



    public function testGetTotalItems(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $paginator = new Paginator($data, 10, "/items/");

        $I->assertEquals(
            100,
            $paginator->getTotalItems()
        );
    }



    public function getTotalPages(UnitTester $I): void
    {
        $itemsPerPage = 10;

        $data = new ArrayData(
            range(1, 95)
        );

        $paginator = new Paginator($data, $itemsPerPage, "/items/");

        $I->assertEquals(
            10,
            $paginator->getTotalPages()
        );
    }

    public function getTotalPagesEmpty(UnitTester $I): void
    {
        $itemsPerPage = 10;

        $data = new ArrayData(
            []
        );

        $paginator = new Paginator($data, $itemsPerPage, "/items/");

        $I->assertEquals(
            1,
            $paginator->getTotalPages()
        );
    }


    ///TODO down...


    public function testGetPage(UnitTester $I): void
    {
        $data = new ArrayData(
            range(1, 100)
        );

        $itemsPerPage = 10;

        $paginator = new Paginator($data, $itemsPerPage, "/items/");

        $page = $paginator->getPage(3);

        $I->assertEquals(
            range(21, 30),
            $page->getData()
        );

        $I->assertEquals(
            3,
            $page->getPageNumber()
        );
    }



    public function testEmptyData(UnitTester $I): void
    {
        $data = new ArrayData(
            []
        );

        $itemsPerPage = 10;

        $paginator = new Paginator($data, $itemsPerPage, "/items/");

        $page = $paginator->getPage(1);

        $I->assertEquals(
            [],
            $page->getData()
        );

        $I->assertEquals(
            1,
            $page->getPageNumber()
        );
    }
}
