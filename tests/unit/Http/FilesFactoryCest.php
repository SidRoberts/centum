<?php

namespace Tests\Http;

use Centum\Http\FilesFactory;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\UnitTester;

class FilesFactoryCest
{
    public function testCreateFromBrowserKitRequestEmpty(UnitTester $I): void
    {
        $browserKitRequest = new BrowserKitRequest(
            "/",
            "GET",
            [],
            [],
            [],
            [],
            null
        );

        $filesFactory = new FilesFactory();

        $files = $filesFactory->createFromBrowserKitRequest($browserKitRequest);

        $I->assertEquals(
            [],
            $files->toArray()
        );
    }
}
