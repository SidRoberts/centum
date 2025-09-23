<?php

namespace Tests\Http;

use Centum\Http\File;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Tests\Support\UnitTester;
use Throwable;

/**
 * @covers \Centum\Http\File
 */
final class FileCest
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



    public function testValidateGoodFile(): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $file->validate();
    }

    public function testValidateFileWithEmptyLocation(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "";
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->expectThrowable(
            new Exception("No known location."),
            function () use ($file): void {
                $file->validate();
            }
        );
    }

    public function testValidateFileWithNullLocation(UnitTester $I): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = null;
        $error    = UPLOAD_ERR_OK;

        $file = new File($name, $type, $size, $location, $error);

        $I->expectThrowable(
            new Exception("No known location."),
            function () use ($file): void {
                $file->validate();
            }
        );
    }



    #[DataProvider("providerValidateBadFileWithError")]
    public function testValidateBadFileWithError(UnitTester $I, Example $example): void
    {
        $name     = "image.png";
        $type     = "image/png";
        $size     = 123456;
        $location = "/tmp/php/php1aaa11";

        /** @var int */
        $error = $example["error"];

        $file = new File($name, $type, $size, $location, $error);

        /** @var Throwable */
        $throwable = $example["throwable"];

        $I->expectThrowable(
            $throwable,
            function () use ($file): void {
                $file->validate();
            }
        );
    }

    /**
     * @return array<array{error: int, throwable: Throwable}>
     */
    protected function providerValidateBadFileWithError(): array
    {
        return [
            [
                "error"     => UPLOAD_ERR_NO_FILE,
                "throwable" => new Exception("No file sent."),
            ],

            [
                "error"     => UPLOAD_ERR_INI_SIZE,
                "throwable" => new Exception("Exceeded filesize limit (\`upload_max_filesize\` directive in php.ini)."),
            ],

            [
                "error"     => UPLOAD_ERR_FORM_SIZE,
                "throwable" => new Exception("Exceeded filesize limit (\`MAX_FILE_SIZE\` directive that was specified in the HTML form)."),
            ],

            [
                "error"     => UPLOAD_ERR_PARTIAL,
                "throwable" => new Exception("The uploaded file was only partially uploaded."),
            ],

            [
                "error"     => UPLOAD_ERR_NO_TMP_DIR,
                "throwable" => new Exception("Missing a temporary folder."),
            ],

            [
                "error"     => UPLOAD_ERR_CANT_WRITE,
                "throwable" => new Exception("Cannot write to target directory. Please fix CHMOD."),
            ],

            [
                "error"     => UPLOAD_ERR_EXTENSION,
                "throwable" => new Exception("A PHP extension stopped the file upload."),
            ],

            [
                "error"     => 9, // Not any known constant.
                "throwable" => new Exception("Unknown file upload error."),
            ],
        ];
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
