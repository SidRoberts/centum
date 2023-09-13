<?php

namespace Centum\App;

use Centum\Console\Exception\ArgvNotFoundException;
use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\App\BootstrapInterface;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;

class ConsoleBootstrap implements BootstrapInterface
{
    public function __construct(
        protected readonly ApplicationInterface $application
    ) {
    }

    /**
     * @throws ArgvNotFoundException
     */
    public function boot(): void
    {
        $terminal = $this->getTerminal();

        $exitCode = $this->application->handle($terminal);

        $this->exit($exitCode);
    }

    /**
     * @throws ArgvNotFoundException
     */
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
