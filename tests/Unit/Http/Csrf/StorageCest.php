<?php

namespace Tests\Unit\Http\Csrf;

use Centum\Http\Csrf\Storage;
use Centum\Http\Session\ArraySession;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\SessionInterface;
use Mockery\MockInterface;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Http\Csrf\Storage
 */
final class StorageCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $storage = $I->mock(Storage::class);

        $I->assertInstanceOf(StorageInterface::class, $storage);
    }



    public function testGet(UnitTester $I): void
    {
        $generatedValue = "abcdefghijkl";

        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock) use ($generatedValue): void {
                $mock->shouldReceive("get")
                    ->with(Storage::TOKEN)
                    ->andReturn($generatedValue);
            }
        );

        $generator = $I->mock(GeneratorInterface::class);

        $storage = new Storage($session, $generator);

        $I->assertEquals(
            $generatedValue,
            $storage->get()
        );
    }

    public function testGetWhenNotAlreadySet(UnitTester $I): void
    {
        $generatedValue = "abcdefghijkl";

        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock) use ($generatedValue): void {
                $mock->shouldReceive("get")
                    ->with(Storage::TOKEN)
                    ->andReturn(null)
                    ->once();

                $mock->shouldReceive("set")
                    ->with(Storage::TOKEN, $generatedValue)
                    ->once();
            }
        );

        $generator = $I->mock(
            GeneratorInterface::class,
            function (MockInterface $mock) use ($generatedValue): void {
                $mock->shouldReceive("generate")
                    ->andReturn($generatedValue)
                    ->once();
            }
        );

        $storage = new Storage($session, $generator);

        $value = $storage->get();

        $I->assertSame(
            $generatedValue,
            $value
        );
    }

    public function testValueIsPersistent(UnitTester $I): void
    {
        $session = new ArraySession();

        $generator = $I->mock(
            GeneratorInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("generate")
                    ->andReturn("abcdefghijkl")
                    ->once();
            }
        );

        $storage = new Storage($session, $generator);

        $I->assertEquals(
            $storage->get(),
            $storage->get()
        );
    }

    public function testReset(UnitTester $I): void
    {
        $session = $I->mock(
            SessionInterface::class,
            function (MockInterface $mock): void {
                $mock->shouldReceive("remove")
                    ->with(Storage::TOKEN)
                    ->once();
            }
        );

        $generator = $I->mock(GeneratorInterface::class);

        $storage = new Storage($session, $generator);

        $storage->reset();
    }
}
