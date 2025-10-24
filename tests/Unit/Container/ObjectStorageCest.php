<?php

namespace Tests\Unit\Container;

use Centum\Container\ObjectStorage;
use Centum\Interfaces\Container\ObjectStorageInterface;
use Tests\Support\Container\Incrementer;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\ObjectStorage
 */
final class ObjectStorageCest
{
    public function testInterfaces(UnitTester $I): void
    {
        $objectStorage = $I->mock(ObjectStorage::class);

        $I->assertInstanceOf(ObjectStorageInterface::class, $objectStorage);
    }



    public function testHas(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testGet(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testSet(UnitTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testRemove(UnitTester $I): void
    {
        $objectStorage = new ObjectStorage();

        $incrementer = new Incrementer();

        $objectStorage->set(Incrementer::class, $incrementer);

        $I->assertTrue(
            $objectStorage->has(Incrementer::class)
        );

        $objectStorage->remove(Incrementer::class);

        $I->assertFalse(
            $objectStorage->has(Incrementer::class)
        );
    }
}
