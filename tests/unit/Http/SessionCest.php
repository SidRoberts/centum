<?php

namespace Tests\Http;

use Centum\Http\Session;
use Centum\Http\Session\HandlerInterface;
use Mockery;
use Tests\UnitTester;

class SessionCest
{
    public function testStart(UnitTester $I)
    {
        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->start()
            ->andReturn(true);

        $session = new Session($handler);

        $I->assertTrue(
            $session->start()
        );
    }

    public function testIsActive(UnitTester $I)
    {
        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->isActive()
            ->andReturn(true);

        $session = new Session($handler);

        $I->assertTrue(
            $session->isActive()
        );
    }



    public function testHas(UnitTester $I)
    {
        $name = "language";

        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->has()
            ->with($name)
            ->andReturn(false);

        $session = new Session($handler);

        $I->assertFalse(
            $session->has($name)
        );
    }

    public function testGet(UnitTester $I)
    {
        $name         = "language";
        $defaultValue = "en";

        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->get()
            ->with($name, $defaultValue)
            ->andReturn($defaultValue);

        $session = new Session($handler);

        $I->assertEquals(
            $defaultValue,
            $session->get($name, $defaultValue)
        );
    }

    public function testSet(UnitTester $I)
    {
        $name  = "language";
        $value = "ko";

        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->set()
            ->with($name, $value);

        $session = new Session($handler);

        $session->set($name, $value);
    }

    public function testRemove(UnitTester $I)
    {
        $name = "language";

        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->remove()
            ->with($name);

        $session = new Session($handler);

        $session->remove($name);
    }

    public function testClear(UnitTester $I)
    {
        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->clear();

        $session = new Session($handler);

        $session->clear();
    }

    public function testAll(UnitTester $I)
    {
        $handler = Mockery::mock(HandlerInterface::class);

        $handler->expects()
            ->all()
            ->andReturn([]);

        $session = new Session($handler);

        $I->assertEquals(
            [],
            $session->all()
        );
    }
}
