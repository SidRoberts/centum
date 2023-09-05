<?php

namespace Tests\Support\Container\Services;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ServiceInterface;
use Centum\Interfaces\Router\RouterInterface;

/**
 * @implements ServiceInterface<RouterInterface>
 */
class RouterService implements ServiceInterface
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }

    /**
     * @psalm-suppress UnusedVariable $container
     */
    public function build(): RouterInterface
    {
        $container = $this->container;

        /** @var RouterInterface */
        return require __DIR__ . "/../../Data/router.php";
    }
}
