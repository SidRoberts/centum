<?php

namespace Tests\Unit\Codeception;

use Centum\Codeception\Connector;
use Centum\Container\Container;
use Centum\Http\Session\ArraySession;
use Centum\Interfaces\Http\SessionInterface;
use Tests\Support\UnitTester;

class ConnectorCest
{
    public function testContainerSessionIsModified(UnitTester $I): void
    {
        $container = new Container();

        new Connector($container);

        $session = $container->get(SessionInterface::class);

        $I->assertInstanceOf(
            ArraySession::class,
            $session
        );
    }
}
