<?php

namespace Centum\App;

use Centum\Console\Exception\ArgvNotFoundException;
use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class ConsoleBootstrap extends Bootstrap
{
    public function boot(ContainerInterface $container): void
    {
        $application = $container->get(ApplicationInterface::class);

        $terminal = $this->getTerminal();

        $exitCode = $application->handle($terminal);

        $this->exit($exitCode);
    }

    protected function getTerminal(): TerminalInterface
    {
        /** @var array<string> */
        $argv = $_SERVER["argv"] ?? throw new ArgvNotFoundException();

        $arguments = new Arguments($argv);

        $terminal = new Terminal($arguments);

        return $terminal;
    }

    protected function exit(int $exitCode): void
    {
        exit($exitCode);
    }
}
