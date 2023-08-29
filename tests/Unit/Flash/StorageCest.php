<?php

namespace Tests\Unit\Flash;

use Centum\Flash\Storage;
use Centum\Interfaces\Flash\MessageBagInterface;
use Centum\Interfaces\Http\SessionInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Flash\Storage
 */
class StorageCest
{
    public function testGet(UnitTester $I): void
    {
        $messageBag = $I->mock(MessageBagInterface::class);

        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock) use ($messageBag): void {
                $mock->shouldReceive("get")
                    ->with(Storage::SESSION_ID)
                    ->andReturn($messageBag);

                $mock->shouldReceive("remove")
                    ->with(Storage::SESSION_ID);
            }
        );

        $storage = new Storage($session);

        $I->assertSame(
            $messageBag,
            $storage->get()
        );
    }

    public function testGetWhenTheresNothingSet(UnitTester $I): void
    {
        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("get")
                    ->with(Storage::SESSION_ID)
                    ->andReturn(null);

                $mock->shouldReceive("remove")
                    ->with(Storage::SESSION_ID);
            }
        );

        $storage = new Storage($session);

        $I->assertInstanceOf(
            MessageBagInterface::class,
            $storage->get()
        );
    }



    public function testSet(UnitTester $I): void
    {
        $messageBag = $I->mock(MessageBagInterface::class);

        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock) use ($messageBag): void {
                $mock->shouldReceive("set")
                    ->with(Storage::SESSION_ID, $messageBag);
            }
        );

        $storage = new Storage($session);

        $storage->set($messageBag);
    }



    public function testReset(UnitTester $I): void
    {
        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("remove")
                    ->with(Storage::SESSION_ID);
            }
        );

        $storage = new Storage($session);

        $storage->reset();
    }
}
