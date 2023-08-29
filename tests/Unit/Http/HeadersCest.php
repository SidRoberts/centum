<?php

namespace Tests\Unit\Http;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Interfaces\Http\HeaderInterface;
use Mockery\MockInterface;
use OutOfRangeException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Headers
 */
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

    public function testAddMultiple(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers();

        $headers->addMultiple(
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



    public function testGet(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers();

        $headers->add($header1);
        $headers->add($header2);
        $headers->add($header3);



        $I->assertSame(
            $header1,
            $headers->get("Content-Type")
        );

        $I->assertSame(
            $header2,
            $headers->get("Last-Modified")
        );

        $I->assertSame(
            $header3,
            $headers->get("Content-Encoding")
        );

        $I->expectThrowable(
            OutOfRangeException::class,
            function () use ($headers) {
                $headers->get("Age");
            }
        );
    }



    public function testHas(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");
        $header2 = new Header("Last-Modified", "Sun, 04 Apr 2021 17:04:00 GMT");
        $header3 = new Header("Content-Encoding", "gzip");



        $headers = new Headers();

        $headers->add($header1);
        $headers->add($header2);
        $headers->add($header3);



        $I->assertTrue(
            $headers->has("Content-Type")
        );

        $I->assertTrue(
            $headers->has("Last-Modified")
        );

        $I->assertTrue(
            $headers->has("Content-Encoding")
        );

        $I->assertFalse(
            $headers->has("Age")
        );
    }



    public function testMatches(UnitTester $I): void
    {
        $header1 = new Header("Content-Type", "text/plain");



        $headers = new Headers();

        $headers->add($header1);



        $I->assertTrue(
            $headers->matches("Content-Type", "text/plain")
        );

        $I->assertFalse(
            $headers->matches("Content-Type", "text/html")
        );
    }



    public function testSend(UnitTester $I): void
    {
        $header1 = $I->mock(
            HeaderInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("Content-Type");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $header2 = $I->mock(
            HeaderInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("getName")
                    ->andReturn("Last-Modified");

                $mock->shouldReceive("send")
                    ->once();
            }
        );

        $header3 = $I->mock(
            HeaderInterface::class,
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
