<?php

namespace Centum\Codeception;

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

    protected ?Terminal $terminal = null;

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
        $container = require $containerFile;

        if (!($container instanceof Container)) {
            throw new TypeError(
                sprintf(
                    "%s does not return a %s instance.",
                    $containerFile,
                    Container::class
                )
            );
        }

        $this->client = new Connector($container);
    }

    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _after(TestInterface $test)
    {
        $this->client   = null;
        $this->terminal = null;
        $this->stdin    = null;
        $this->stdout   = null;
        $this->stderr   = null;

        parent::_after($test);
    }



    /**
     * @param list<string> $argv
     */
    public function getTerminal(array $argv): Terminal
    {
        if (!$this->terminal) {
            $this->stdin  = fopen("php://memory", "r");
            $this->stdout = fopen("php://memory", "w");
            $this->stderr = fopen("php://memory", "w");

            $this->terminal = new Terminal($argv, $this->stdin, $this->stdout, $this->stderr);
        }

        return $this->terminal;
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
}
