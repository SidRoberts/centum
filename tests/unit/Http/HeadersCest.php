<?php

namespace Tests\Unit\Http;

use Centum\Http\Header;
use Centum\Http\Headers;
use Mockery;
use Mockery\MockInterface;
use Tests\UnitTester;

class HeadersCest
{

    public function testConstructor(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers(
            [
                $header1,
                $header2,
                $header3,
            ]
        );



        $I->assertEquals(
            [
                "Content-Type"     => $header1,
                "Last-Modified"    => $header2,
                "Content-Encoding" => $header3,
            ],
            $headers->all()
        );
    }



    public function testAdd(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers();

        $headers->add($header1);
        $headers->add($header2);
        $headers->add($header3);



        $I->assertEquals(
            [
                "Content-Type"     => $header1,
                "Last-Modified"    => $header2,
                "Content-Encoding" => $header3,
            ],
            $headers->all()
        );
    }



    public function testSend(UnitTester $I): void
    {
        $header1 = Mockery::mock(
            Header::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("Content-Type");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $header2 = Mockery::mock(
            Header::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("Last-Modified");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $header3 = Mockery::mock(
            Header::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("Content-Encoding");

                $mock->shouldReceive("send")
                    ->once();
            }
        );



        $headers = new Headers();

        $headers->add($header1);
        $headers->add($header2);
        $headers->add($header3);

        $headers->send();
    }

    public function testAll(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers();

        $headers->add($header1);
        $headers->add($header2);
        $headers->add($header3);



        $I->assertEquals(
            [
                "Content-Type"     => $header1,
                "Last-Modified"    => $header2,
                "Content-Encoding" => $header3,
            ],
            $headers->all()
        );
    }
}
