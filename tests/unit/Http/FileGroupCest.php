<?php

namespace Tests\Http;

use Centum\Http\File;
use Centum\Http\FileGroup;
use Codeception\Example;
use Tests\UnitTester;

class FileGroupCest
{
    public function testGetID(UnitTester $I): void
    {
        $id = "images";

        $fileGroup = new FileGroup($id);

        $I->assertEquals(
            $id,
            $fileGroup->getID()
        );
    }



    public function testAdd(UnitTester $I): void
    {
        $fileGroup = new FileGroup("images");
    }



    /** @dataProvider providerAll */
    public function testAll(UnitTester $I, Example $example): void
    {
        $fileGroup = new FileGroup("images");

        /** @var array<File> */
        $files = $example["files"];

        foreach ($files as $file) {
            $fileGroup->add($file);
        }

        /** @var array<File> */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $fileGroup->all()
        );

        $I->markTestIncomplete();
    }

    protected function providerAll(): array
    {
        $file1 = new File("image.png", "image/png", 123456, "/tmp/php/php1aaa11", UPLOAD_ERR_OK);

        return [
            [
                "files"    => [],
                "expected" => [],
            ],

            [
                "files" => [
                    $file1,
                ],
                "expected" => [
                    $file1,
                ],
            ],
        ];
    }



    /** @dataProvider providerToArray */
    public function testToArray(UnitTester $I, Example $example): void
    {
        $fileGroup = new FileGroup("images");

        /** @var array<File> */
        $files = $example["files"];

        foreach ($files as $file) {
            $fileGroup->add($file);
        }

        /** @var array<File> */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $fileGroup->toArray()
        );

        $I->markTestIncomplete();
    }

    protected function providerToArray(): array
    {
        $file1 = new File("image.png", "image/png", 123456, "/tmp/php/php1aaa11", UPLOAD_ERR_OK);

        return [
            [
                "files"    => [],
                "expected" => [],
            ],

            [
                "files" => [
                    $file1,
                ],
                "expected" => [
                    $file1->toArray(),
                ],
            ],
        ];
    }
}
