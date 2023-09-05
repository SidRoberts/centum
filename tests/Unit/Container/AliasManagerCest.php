<?php

namespace Tests\Unit\Container;

use Centum\Access\Access;
use Centum\Container\AliasManager;
use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Console\CommandInterface;
use stdClass;
use Tests\Support\Container\Alias\ACommand;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\AliasManager
 */
class AliasManagerCest
{
    public function testAdd(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $aliasManager->add(CommandInterface::class, ACommand::class);

        $alias = $aliasManager->get(CommandInterface::class);

        $I->assertEquals(
            $alias,
            ACommand::class
        );
    }



    public function testGet(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $I->assertEquals(
            Access::class,
            $aliasManager->get(AccessInterface::class)
        );
    }

    public function testGetClassDoesntHaveAnAlias(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $I->assertEquals(
            stdClass::class,
            $aliasManager->get(stdClass::class)
        );
    }



    public function testHas(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $I->assertTrue(
            $aliasManager->has(AccessInterface::class)
        );

        $I->assertFalse(
            $aliasManager->has(stdClass::class)
        );
    }



    public function testRemove(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $aliasManager->remove(AccessInterface::class);

        $I->assertEquals(
            AccessInterface::class,
            $aliasManager->get(AccessInterface::class)
        );
    }
}
