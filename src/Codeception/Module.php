<?php

namespace Centum\Codeception;

use Centum\Container\Container;
use Codeception\Configuration;
use Codeception\Lib\Framework;
use Codeception\TestInterface;
use Symfony\Component\DomCrawler\Crawler;

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

        $this->client = new Connector($container);
    }

    /**
     * @return void
     *
     * @psalm-suppress all
     */
    public function _after(TestInterface $test)
    {
        $this->client = null;

        parent::_after($test);
    }
}
