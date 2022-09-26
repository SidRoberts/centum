<?php

namespace Tests\Unit\Http;

use Centum\Http\Session;
use Centum\Interfaces\Http\Session\HandlerInterface;
use Mockery;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

class SessionCest
{
    public function testStart(UnitTester $I): void
    {
        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("start")
                    ->andReturn(true);
            }
        );

        $session = new Session($handler);

        $I->assertTrue(
            $session->start()
        );
    }

    public function testIsActive(UnitTester $I): void
    {
        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("isActive")
                    ->andReturn(true);
            }
        );

        $session = new Session($handler);

        $I->assertTrue(
            $session->isActive()
        );
    }



    public function testHas(UnitTester $I): void
    {
        $name = "language";

        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock) use ($name): void {
                $mock->shouldReceive("has")
                    ->with($name)
                    ->andReturn(false);
            }
        );

        $session = new Session($handler);

        $I->assertFalse(
            $session->has($name)
        );
    }

    public function testGet(UnitTester $I): void
    {
        $name         = "language";
        $defaultValue = "en";

        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock) use ($name, $defaultValue): void {
                $mock->shouldReceive("get")
                    ->with($name, $defaultValue)
                    ->andReturn($defaultValue);
            }
        );

        $session = new Session($handler);

        $I->assertEquals(
            $defaultValue,
            $session->get($name, $defaultValue)
        );
    }

    public function testSet(UnitTester $I): void
    {
        $name  = "language";
        $value = "ko";

        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock) use ($name, $value): void {
                $mock->shouldReceive("set")
                    ->with($name, $value);
            }
        );

        $session = new Session($handler);

        $session->set($name, $value);
    }

    public function testRemove(UnitTester $I): void
    {
        $name = "language";

        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock) use ($name): void {
                $mock->shouldReceive("remove")
                    ->with($name);
            }
        );

        $session = new Session($handler);

        $session->remove($name);
    }

    public function testClear(UnitTester $I): void
    {
        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("clear");
            }
        );

        $session = new Session($handler);

        $session->clear();
    }

    public function testAll(UnitTester $I): void
    {
        $handler = Mockery::mock(
            HandlerInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("all")
                    ->andReturn([]);
            }
        );

        $session = new Session($handler);

        $I->assertEquals(
            [],
            $session->all()
        );
    }
}
