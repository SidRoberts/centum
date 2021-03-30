<?php

namespace Centum\Boot;

use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ConsoleBootstrap extends Bootstrap
{
    public function boot(Container $container): void
    {
        /**
         * @var Application
         */
        $console = $container->typehintClass(Application::class);

        $terminal = new Terminal();

        $exitCode = $console->handle($terminal);

        exit($exitCode);
    }
}
