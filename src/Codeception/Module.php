<?php

namespace Centum\Codeception;

use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Console\Terminal;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Codeception\Configuration;
use Codeception\Lib\Framework;
use Codeception\TestInterface;
use Exception;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Throwable;
use TypeError;

class Module extends Framework
{
    public ?AbstractBrowser $client = null;

    /**
     * @var array<string, string>
     *
     * @psalm-suppress all
     */
    protected array $config = [
        "container" => "config/container.php",
    ];

    protected ?ContainerInterface $container = null;

    protected ?int $exitCode = null;

    /** @var ?resource */
    protected $stdin = null;

    /** @var ?resource */
    protected $stdout = null;

    /** @var ?resource */
    protected $stderr = null;



    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _beforeSuite($settings = [])
    {
        parent::_beforeSuite($settings);

        $this->makeNewContainer();
    }

    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _before(TestInterface $test)
    {
        parent::_before($test);

        $this->makeNewContainer();

        $this->client = new Connector($this->container);
    }

    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _after(TestInterface $test)
    {
        parent::_after($test);

        $this->container = null;
        $this->exitCode  = null;
        $this->stdin     = null;
        $this->stdout    = null;
        $this->stderr    = null;
    }

    /**
     * @return void
     */
    public function _afterSuite()
    {
        $this->container = null;
    }





    public function makeNewContainer(): void
    {
        $containerFile = Configuration::projectDir() . $this->config["container"];

        if (!file_exists($containerFile)) {
            throw new Exception(
                sprintf(
                    "%s container file does not exist.",
                    $containerFile
                )
            );
        }

        /** @var mixed */
        $container = require $containerFile;

        if (!($container instanceof ContainerInterface)) {
            throw new TypeError(
                sprintf(
                    "%s does not return a %s instance.",
                    $containerFile,
                    ContainerInterface::class
                )
            );
        }

        $this->container = $container;
    }



    public function getContainer(): ContainerInterface
    {
        if (!$this->container) {
            throw new ContainerNotFoundException();
        }

        return $this->container;
    }

    /**
     * @param class-string $class
     */
    public function addToContainer(string $class, object $object): void
    {
        $container = $this->getContainer();

        $container->set($class, $object);
    }



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



    public function getEchoContent(callable $callable): string
    {
        ob_start();

        try {
            $callable();
        } catch (Throwable $throwable) {
            ob_end_clean();

            throw $throwable;
        }

        return ob_get_clean();
    }



    public function expectEcho(string $expected, callable $callable): void
    {
        $actual = $this->getEchoContent($callable);

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting callable echoes an expected string."
        );
    }
}
