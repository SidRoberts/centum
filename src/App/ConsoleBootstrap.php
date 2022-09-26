<?php

namespace Centum\App;

use Centum\Console\Application;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class ConsoleBootstrap extends Bootstrap
{
    public function boot(ContainerInterface $container): void
    {
        $application = $container->get(Application::class);

        $terminal = $container->get(TerminalInterface::class);

        $exitCode = $application->handle($terminal);

        $this->exit($exitCode);
    }

    protected function exit(int $exitCode): void
    {
        exit($exitCode);
    }
}
