<?php

namespace Tests\Support;

use Centum\Console\Terminal;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class ConsoleTester extends Actor
{
    use _generated\ConsoleTesterActions;



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



    public function getStdoutContent(): string
    {
        if (!$this->stdout) {
            return "";
        }

        rewind($this->stdout);

        return stream_get_contents($this->stdout);
    }

    public function getStderrContent(): string
    {
        if (!$this->stderr) {
            return "";
        }

        rewind($this->stderr);

        return stream_get_contents($this->stderr);
    }



    public function getConsoleApplication(): ApplicationInterface
    {
        $container = $this->getContainer();

        return $container->get(ApplicationInterface::class);
    }



    public function addCommand(CommandInterface $command): void
    {
        $application = $this->getConsoleApplication();

        $application->addCommand($command);
    }

    /**
     * @param list<string> $argv
     */
    public function runCommand(array $argv): int
    {
        $application = $this->getConsoleApplication();
        $terminal    = $this->createTerminal($argv);

        $this->exitCode = $application->handle($terminal);

        return $this->exitCode;
    }



    public function assertExitCodeIs(int $expected, string $message = ""): void
    {
        $this->assertSame(
            $expected,
            $this->exitCode,
            $message
        );
    }

    public function assertExitCodeIsNot(int $expected, string $message = ""): void
    {
        $this->assertNotSame(
            $expected,
            $this->exitCode,
            $message
        );
    }



    public function assertStdoutEquals(string $expected, string $message = ""): void
    {
        $this->assertEquals(
            $expected,
            $this->getStdoutContent(),
            $message
        );
    }

    public function assertStdoutNotEquals(string $expected, string $message = ""): void
    {
        $this->assertNotEquals(
            $expected,
            $this->getStdoutContent(),
            $message
        );
    }

    public function assertStdoutContains(string $expected, string $message = ""): void
    {
        $this->assertStringContainsString(
            $expected,
            $this->getStdoutContent(),
            $message
        );
    }

    public function assertStdoutNotContains(string $expected, string $message = ""): void
    {
        $this->assertStringNotContainsString(
            $expected,
            $this->getStdoutContent(),
            $message
        );
    }



    public function assertStderrEquals(string $expected, string $message = ""): void
    {
        $this->assertEquals(
            $expected,
            $this->getStderrContent(),
            $message
        );
    }

    public function assertStderrNotEquals(string $expected, string $message = ""): void
    {
        $this->assertNotEquals(
            $expected,
            $this->getStderrContent(),
            $message
        );
    }

    public function assertStderrContains(string $expected, string $message = ""): void
    {
        $this->assertStringContainsString(
            $expected,
            $this->getStderrContent(),
            $message
        );
    }

    public function assertStderrNotContains(string $expected, string $message = ""): void
    {
        $this->assertStringNotContainsString(
            $expected,
            $this->getStderrContent(),
            $message
        );
    }
}
