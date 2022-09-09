<?php

namespace Tests\Http;

use Centum\Http\File;
use Centum\Http\FileGroup;
use Centum\Http\Files;
use Codeception\Example;
use OutOfBoundsException;
use OverflowException;
use Tests\UnitTester;

class FilesCest
{
    public function testAdd(UnitTester $I): void
    {
        $id = "images";

        $fileGroup = new FileGroup($id);

        $files = new Files();

        $files->add($fileGroup);

        $I->assertSame(
            $fileGroup,
            $files->get($id)
        );
    }

    public function testAddTheSameTwice(UnitTester $I): void
    {
        $id = "images";

        $fileGroup = new FileGroup($id);

        $files = new Files();

        $files->add($fileGroup);

        $I->expectThrowable(
            OverflowException::class,
            function () use ($files, $fileGroup) {
                $files->add($fileGroup);
            }
        );
    }



    public function testHas(UnitTester $I): void
    {
        $files = new Files();

        $fileGroupA = new FileGroup("a");
        $fileGroupB = new FileGroup("b");

        $files->add($fileGroupA);
        $files->add($fileGroupB);

        $I->assertTrue(
            $files->has("a")
        );

        $I->assertTrue(
            $files->has("b")
        );

        $I->assertFalse(
            $files->has("c")
        );
    }



    public function testGet(UnitTester $I): void
    {
        $id = "images";

        $fileGroup = new FileGroup($id);

        $files = new Files();

        $files->add($fileGroup);

        $I->assertSame(
            $fileGroup,
            $files->get($id)
        );
    }

    public function testGetDoesntExist(UnitTester $I): void
    {
        $I->expectThrowable(
            OutOfBoundsException::class,
            function () {
                $files = new Files();

                $files->get("doesnt-exist");
            }
        );
    }



    /** @dataProvider providerAll */
    public function testAll(UnitTester $I, Example $example): void
    {
        /** @var array<FileGroups> */
        $fileGroups = $example["fileGroups"];

        $files = new Files($fileGroups);

        /** @var array<FileGroups> */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $files->all()
        );

        $I->markTestIncomplete();
    }

    protected function providerAll(): array
    {
        return [
            [
                "fileGroups" => [],
                "expected"   => [],
            ],

            [
                "fileGroups" => [
                    new FileGroup("images"),
                ],
                "expected" => [
                    "images" => new FileGroup("images"),
                ],
            ],
        ];
    }



    /** @dataProvider providerToArray */
    public function testToArray(UnitTester $I, Example $example): void
    {
        /** @var array<FileGroups> */
        $fileGroups = $example["fileGroups"];

        $files = new Files($fileGroups);

        /** @var array<FileGroups> */
        $expected = $example["expected"];

        $I->assertEquals(
            $expected,
            $files->toArray()
        );

        $I->markTestIncomplete();
    }

    protected function providerToArray(): array
    {
        $emptyFileGroup = new FileGroup("images");

        $fileGroup1 = new FileGroup("one");

        $fileGroup1->add(
            new File("image1.png", "image/png", 123, "/tmp/php/php1aaa11", UPLOAD_ERR_OK)
        );

        $fileGroup1->add(
            new File("image2.png", "image/png", 456, "/tmp/php/php2aaa22", UPLOAD_ERR_OK)
        );

        $fileGroup2 = new FileGroup("two");

        $fileGroup2->add(
            new File("image3.png", "image/png", 789, "/tmp/php/php3aaa33", UPLOAD_ERR_OK)
        );

        return [
            [
                "fileGroups" => [],
                "expected"   => [],
            ],

            [
                "fileGroups" => [
                    $emptyFileGroup,
                ],
                "expected" => [
                    "images" => [],
                ],
            ],

            [
                "fileGroups" => [
                    $fileGroup1,
                    $fileGroup2,
                ],
                "expected" => [
                    "one" => $fileGroup1->toArray(),
                    "two" => $fileGroup2->toArray(),
                ],
            ],
        ];
    }
}