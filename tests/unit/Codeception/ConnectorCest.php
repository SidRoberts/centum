<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Container\Container;
use Centum\Http\Session\ArrayHandler;
use Centum\Http\Session\HandlerInterface;
use Tests\UnitTester;

class ConnectorCest
{
    public function containerSessionIsModified(UnitTester $I): void
    {
        $container = new Container();

        $connector = new Connector($container);

        $sessionHandler = $container->typehintClass(HandlerInterface::class);

        $I->assertInstanceOf(
            ArrayHandler::class,
            $sessionHandler
        );
    }
}
