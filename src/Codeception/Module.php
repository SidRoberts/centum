<?php

namespace Centum\Codeception;

use Centum\Console\Application;
use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Codeception\Configuration;
use Codeception\Lib\Framework;
use Codeception\TestInterface;
use Symfony\Component\DomCrawler\Crawler;
use TypeError;

class Module extends Framework
{
    /**
     * @var ?Connector
     *
     * @psalm-suppress all
     */
    public $client = null;

    /**
     * @var ?Crawler
     *
     * @psalm-suppress all
     */
    protected $crawler = null;

    /**
     * @var array<string, string>
     *
     * @psalm-suppress all
     */
    protected $config = [
        "container" => "config/container.php",
    ];

    protected ?Container $container = null;

    /**
     * @var ?resource
     */
    protected $stdin = null;

    /**
     * @var ?resource
     */
    protected $stdout = null;

    /**
     * @var ?resource
     */
    protected $stderr = null;



    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _before(TestInterface $test)
    {
        $containerFile = Configuration::projectDir() . $this->config["container"];

        if (!file_exists($containerFile)) {
            throw new \Exception(
                sprintf(
                    "%s container file does not exist.",
                    $containerFile
                )
            );
        }

        /**
         * @var Container
         */
        $this->container = require $containerFile;

        if (!($this->container instanceof Container)) {
            throw new TypeError(
                sprintf(
                    "%s does not return a %s instance.",
                    $containerFile,
                    Container::class
                )
            );
        }

        $this->client = new Connector($this->container);
    }

    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _after(TestInterface $test)
    {
        $this->client = null;
        $this->stdin  = null;
        $this->stdout = null;
        $this->stderr = null;

        parent::_after($test);
    }



    public function getContainer(): Container
    {
        if (!$this->container) {
            throw new \Exception("Couldn't find the Container.");
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
    public function createTerminal(array $argv): Terminal
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

    public function getConsoleApplication(): Application
    {
        $container = $this->getContainer();

        /**
         * @var Application
         */
        return $container->typehintClass(Application::class);
    }

    public function addCommand(Command $command): void
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

        $exitCode = $application->handle($terminal);

        return $exitCode;
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
