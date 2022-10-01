<?php

namespace Centum\Codeception\Actions;

use Centum\Console\Terminal;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
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
        $this->stdin  = fopen("php://memory", "r");
        $this->stdout = fopen("php://memory", "w");
        $this->stderr = fopen("php://memory", "w");

        return new Terminal($argv, $this->stdin, $this->stdout, $this->stderr);
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



    public function addCommand(CommandInterface $command): void
    {
        $application = $this->grabConsoleApplication();

        $application->addCommand($command);
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



    public function seeExitCodeIs(int $expected, string $message = ""): void
    {
        Assert::assertSame(
            $expected,
            $this->exitCode,
            $message
        );
    }

    public function seeExitCodeIsNot(int $expected, string $message = ""): void
    {
        Assert::assertNotSame(
            $expected,
            $this->exitCode,
            $message
        );
    }



    public function seeStdoutEquals(string $expected, string $message = ""): void
    {
        Assert::assertEquals(
            $expected,
            $this->grabStdoutContent(),
            $message
        );
    }

    public function seeStdoutNotEquals(string $expected, string $message = ""): void
    {
        Assert::assertNotEquals(
            $expected,
            $this->grabStdoutContent(),
            $message
        );
    }

    public function seeStdoutContains(string $expected, string $message = ""): void
    {
        Assert::assertStringContainsString(
            $expected,
            $this->grabStdoutContent(),
            $message
        );
    }

    public function seeStdoutNotContains(string $expected, string $message = ""): void
    {
        Assert::assertStringNotContainsString(
            $expected,
            $this->grabStdoutContent(),
            $message
        );
    }



    public function seeStderrEquals(string $expected, string $message = ""): void
    {
        Assert::assertEquals(
            $expected,
            $this->grabStderrContent(),
            $message
        );
    }

    public function seeStderrNotEquals(string $expected, string $message = ""): void
    {
        Assert::assertNotEquals(
            $expected,
            $this->grabStderrContent(),
            $message
        );
    }

    public function seeStderrContains(string $expected, string $message = ""): void
    {
        Assert::assertStringContainsString(
            $expected,
            $this->grabStderrContent(),
            $message
        );
    }

    public function seeStderrNotContains(string $expected, string $message = ""): void
    {
        Assert::assertStringNotContainsString(
            $expected,
            $this->grabStderrContent(),
            $message
        );
    }
}
