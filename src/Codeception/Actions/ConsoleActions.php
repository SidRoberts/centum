<?php

namespace Centum\Codeception\Actions;

use Centum\Console\Application;
use Centum\Console\CommandMetadata;
use Centum\Console\Terminal;
use Centum\Console\Terminal\Arguments;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Codeception\Exception\ModuleException;
use PHPUnit\Framework\Assert;

trait ConsoleActions
{
    abstract public function grabContainer(): ContainerInterface;



    protected ?int $exitCode = null;

    /** @var ?resource */
    protected $stdin = null;

    /** @var ?resource */
    protected $stdout = null;

    /** @var ?resource */
    protected $stderr = null;



    /**
     * @param list<string> $argv
     */
    public function createTerminal(array $argv): TerminalInterface
    {
        $arguments = new Arguments($argv);

        $this->stdin  = fopen("php://memory", "r");
        $this->stdout = fopen("php://memory", "w");
        $this->stderr = fopen("php://memory", "w");

        return new Terminal($arguments, $this->stdin, $this->stdout, $this->stderr);
    }



    public function grabStdoutContent(): string
    {
        if (!$this->stdout) {
            return "";
        }

        rewind($this->stdout);

        return stream_get_contents($this->stdout);
    }

    public function grabStderrContent(): string
    {
        if (!$this->stderr) {
            return "";
        }

        rewind($this->stderr);

        return stream_get_contents($this->stderr);
    }



    public function grabConsoleApplication(): ApplicationInterface
    {
        $container = $this->grabContainer();

        return $container->get(ApplicationInterface::class);
    }



    /**
     * @param class-string $commandClass
     */
    public function addCommand(string $commandClass): void
    {
        $application = $this->grabConsoleApplication();

        $application->addCommand($commandClass);
    }

    /**
     * @param list<string> $argv
     */
    public function runCommand(array $argv): int
    {
        $application = $this->grabConsoleApplication();
        $terminal    = $this->createTerminal($argv);

        $this->exitCode = $application->handle($terminal);

        return $this->exitCode;
    }



    public function grabExitCode(): int
    {
        return $this->exitCode ?? throw new ModuleException($this, "Command hasn't been executed yet.");
    }

    public function seeExitCodeIs(int $expected): void
    {
        Assert::assertSame(
            $expected,
            $this->exitCode
        );
    }

    public function seeExitCodeIsNot(int $expected): void
    {
        Assert::assertNotSame(
            $expected,
            $this->exitCode
        );
    }



    public function seeStdoutEquals(string $expected): void
    {
        Assert::assertEquals(
            $expected,
            $this->grabStdoutContent()
        );
    }

    public function seeStdoutNotEquals(string $expected): void
    {
        Assert::assertNotEquals(
            $expected,
            $this->grabStdoutContent()
        );
    }

    public function seeStdoutContains(string $expected): void
    {
        Assert::assertStringContainsString(
            $expected,
            $this->grabStdoutContent()
        );
    }

    public function seeStdoutNotContains(string $expected): void
    {
        Assert::assertStringNotContainsString(
            $expected,
            $this->grabStdoutContent()
        );
    }



    public function seeStderrEquals(string $expected): void
    {
        Assert::assertEquals(
            $expected,
            $this->grabStderrContent()
        );
    }

    public function seeStderrNotEquals(string $expected): void
    {
        Assert::assertNotEquals(
            $expected,
            $this->grabStderrContent()
        );
    }

    public function seeStderrContains(string $expected): void
    {
        Assert::assertStringContainsString(
            $expected,
            $this->grabStderrContent()
        );
    }

    public function seeStderrNotContains(string $expected): void
    {
        Assert::assertStringNotContainsString(
            $expected,
            $this->grabStderrContent()
        );
    }



    /**
     * @param class-string $commandClass
     */
    public function grabCommandMetadata(string $commandClass): CommandMetadata
    {
        $container = $this->grabContainer();

        $application = new Application($container);

        return $application->getCommandMetadata($commandClass);
    }
}
