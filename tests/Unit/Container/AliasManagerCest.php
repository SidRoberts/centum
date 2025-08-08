<?php

namespace Tests\Unit\Container;

use Centum\Access\Access;
use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Container\AliasManager;
use Centum\Cron\Cron;
use Centum\Flash\Flash;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Flash\Storage as FlashStorage;
use Centum\Http\Csrf\Generator;
use Centum\Http\Csrf\Storage;
use Centum\Http\Csrf\Validator;
use Centum\Http\Request;
use Centum\Http\Session\GlobalSession;
use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Flash\FlashInterface;
use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\StorageInterface as FlashStorageInterface;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Interfaces\Url\UrlInterface;
use Centum\Queue\TaskRunner;
use Centum\Router\Router;
use Centum\Url\Url;
use stdClass;
use Tests\Support\Container\Alias\ACommand;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\AliasManager
 */
final class AliasManagerCest
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



    public function testGetAll(UnitTester $I): void
    {
        $aliasManager = new AliasManager();

        $I->assertEquals(
            [
                AccessInterface::class       => Access::class,
                ApplicationInterface::class  => Application::class,
                TerminalInterface::class     => Terminal::class,
                CronInterface::class         => Cron::class,
                GeneratorInterface::class    => Generator::class,
                StorageInterface::class      => Storage::class,
                ValidatorInterface::class    => Validator::class,
                FlashInterface::class        => Flash::class,
                FormatterInterface::class    => HtmlFormatter::class,
                FlashStorageInterface::class => FlashStorage::class,
                RequestInterface::class      => Request::class,
                SessionInterface::class      => GlobalSession::class,
                TaskRunnerInterface::class   => TaskRunner::class,
                RouterInterface::class       => Router::class,
                UrlInterface::class          => Url::class,
            ],
            $aliasManager->getAll()
        );
    }
}
