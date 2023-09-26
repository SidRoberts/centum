<?php

namespace Tests\Unit\Container;

use Centum\Container\ServiceStorage;
use Tests\Support\Container\Incrementer;
use Tests\Support\Container\Services\IncrementerService;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\ServiceStorage
 */
final class ServiceStorageCest
{
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
        $serviceStorage = new ServiceStorage();

        $serviceStorage->set(Incrementer::class, IncrementerService::class);

        $I->assertTrue(
            $serviceStorage->has(Incrementer::class)
        );

        $serviceStorage->remove(Incrementer::class);

        $I->assertFalse(
            $serviceStorage->has(Incrementer::class)
        );
    }
}
