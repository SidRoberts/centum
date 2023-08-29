<?php

namespace Tests\Http;

use Centum\Http\FilesFactory;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\FilesFactory
 */
class FilesFactoryCest
{
    #[DataProvider("providerCreateFromArray")]
    public function testCreateFromArray(UnitTester $I, Example $example): void
    {
        /** @var array<string, array> */
        $array = $example["array"];

        /** @var array<string, array> */
        $expected = $example["expected"];

        $filesFactory = new FilesFactory();

        $files = $filesFactory->createFromArray($array);

        $I->assertEquals(
            $expected,
            $files->toArray()
        );
    }

    protected function providerCreateFromArray(): array
    {
        return [
            [
                "array" => [
                    "image" => [
                        "name"      => "image.png",
                        "type"      => "image/png",
                        "size"      => 123456,
                        "tmp_name"  => "/tmp/php/php1aaa11",
                        "error"     => UPLOAD_ERR_OK,
                        "full_path" => "/home/user/image.png",
                    ],
                ],

                "expected" => [
                    "image" => [
                        [
                            "name"     => "image.png",
                            "type"     => "image/png",
                            "size"     => 123456,
                            "location" => "/tmp/php/php1aaa11",
                            "error"    => UPLOAD_ERR_OK,
                        ],
                    ],
                ],
            ],

            [
                "array" => [
                    "images" => [
                        "name"      => ["image.png", "image.jpg"],
                        "type"      => ["image/png", "image/jpeg"],
                        "size"      => [123, 456],
                        "tmp_name"  => ["/tmp/php/php1aaa11", "/tmp/php/php2aaa22"],
                        "error"     => [UPLOAD_ERR_OK, UPLOAD_ERR_OK],
                        "full_path" => ["/home/user/image.png", "/home/user/image.jpg"],
                    ],
                ],

                "expected" => [
                    "images" => [
                        [
                            "name"     => "image.png",
                            "type"     => "image/png",
                            "size"     => 123,
                            "location" => "/tmp/php/php1aaa11",
                            "error"    => UPLOAD_ERR_OK,
                        ],
                        [
                            "name"     => "image.jpg",
                            "type"     => "image/jpeg",
                            "size"     => 456,
                            "location" => "/tmp/php/php2aaa22",
                            "error"    => UPLOAD_ERR_OK,
                        ],
                    ],
                ],
            ],
        ];
    }



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



    public function testCreateFromBrowserKitRequestWithFilesThrowsException(UnitTester $I): void
    {
        $browserKitRequest = new BrowserKitRequest(
            "/",
            "GET",
            [],
            [
                "file" => [
                    "name"     => "myfile.pdf",
                    "tmp_name" => "/var/myfile.pdf",
                ],
            ],
            [],
            [],
            null
        );

        $filesFactory = new FilesFactory();

        $I->expectThrowable(
            new Exception(
                "Not implemented due to being unable to get the file location of a PSR7 UploadedFile."
            ),
            function () use ($filesFactory, $browserKitRequest): void {
                $filesFactory->createFromBrowserKitRequest($browserKitRequest);
            }
        );
    }
}
