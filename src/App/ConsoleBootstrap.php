<?php

namespace Centum\App;

use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Container\Container;

class ConsoleBootstrap extends Bootstrap
{
    public function boot(Container $container): void
    {
        $application = $container->typehintClass(Application::class);

        $terminal = $container->typehintClass(Terminal::class);

        $exitCode = $application->handle($terminal);

        $this->exit($exitCode);
    }

    protected function exit(int $exitCode): void
    {
        exit($exitCode);
    }
}
