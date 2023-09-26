<?php

namespace Tests\Unit\Http\Exception;

use Centum\Http\Exception\FileAlreadyMovedException;
use Centum\Http\File;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Exception\FileAlreadyMovedException
 */
final class FileAlreadyMovedExceptionCest
{
    public function test(UnitTester $I): void
    {
        $file = new File("image1.png", "image/png", 123, "/tmp/php/php1aaa11", UPLOAD_ERR_OK);

        $exception = new FileAlreadyMovedException($file);

        $I->assertEquals(
            $file,
            $exception->getCentumFile()
        );
    }
}
