<?php

namespace Tests\Http;

use Centum\Http\File;
use Exception;
use Tests\UnitTester;

class FileCest
{
    public function testGetters(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->assertEquals(
            $name,
            $file->getName()
        );

        $I->assertEquals(
            $type,
            $file->getType()
        );

        $I->assertEquals(
            $size,
            $file->getSize()
        );

        $I->assertEquals(
            $location,
            $file->getLocation()
        );

        $I->assertEquals(
            $error,
            $file->getError()
        );
    }


    public function testIsMoved(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->assertFalse(
            $file->isMoved()
        );
    }

    public function testIsMovedAfterMoving(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testGetExtension(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->assertEquals(
            "png",
            $file->getExtension()
        );
    }

    public function testGetExtensionError(UnitTester $I): void
    {
        $name     = null;
        $type     = null;
        $size     = 0;
        $location = null;
        $error    = UPLOAD_ERR_NO_FILE;

        $file = new File($name, $type, $size, $location, $error);

        $I->expectThrowable(
            new Exception("File has an error."),
            function () use ($file): void {
                $file->getExtension();
            }
        );
    }



    public function testMoveTo(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testMoveToWithError(UnitTester $I): void
    {
        $file = new File(null, null, 0, null, UPLOAD_ERR_NO_FILE);

        $I->expectThrowable(
            new Exception("File has an error."),
            function () use ($file): void {
                $file->moveTo("/tmp/abc123");
            }
        );
    }



    public function testToArray(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->assertEquals(
            [
                "name"     => $name,
                "type"     => $type,
                "size"     => $size,
                "location" => $location,
                "error"    => $error,
            ],
            $file->toArray()
        );
    }
}
