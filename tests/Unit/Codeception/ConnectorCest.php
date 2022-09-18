<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Container\Container;
use Centum\Http\Session\ArrayHandler;
use Centum\Http\Session\HandlerInterface;
use Tests\Support\UnitTester;

class ConnectorCest
{
    public function testContainerSessionIsModified(UnitTester $I): void
    {
        $container = new Container();

        new Connector($container);

        $sessionHandler = $container->typehintClass(HandlerInterface::class);

        $I->assertInstanceOf(
            ArrayHandler::class,
            $sessionHandler
        );
    }
}
