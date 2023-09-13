<?php

namespace Centum\Codeception;

use Centum\Codeception\Exception\ContainerNotFoundException;
use Centum\Interfaces\Container\ContainerInterface;
use Codeception\Configuration;
use Codeception\Module as CodeceptionModule;
use Codeception\TestInterface;
use Exception;
use Mockery;
use Mockery\MockInterface;
use TypeError;

class Module extends CodeceptionModule
{
    /**
     * @var array<string, string>
     *
     * @psalm-suppress NonInvariantDocblockPropertyType
     */
    protected array $config = [
        "container" => "config/container.php",
    ];

    protected ?ContainerInterface $container = null;



    /**
     * @param array<mixed> $settings
     *
     * @return void
     *
     * @throws Exception
     * @throws TypeError
     */
    public function _beforeSuite(array $settings = [])
    {
        parent::_beforeSuite($settings);

        $this->makeNewContainer();
    }

    /**
     * @return void
     *
     * @throws Exception
     * @throws TypeError
     */
    public function _before(TestInterface $test)
    {
        parent::_before($test);

        $this->makeNewContainer();
    }

    /**
     * @return void
     */
    public function _after(TestInterface $test)
    {
        parent::_after($test);

        $this->container = null;
    }

    /**
     * @return void
     */
    public function _afterSuite()
    {
        $this->container = null;
    }



    /**
     * @throws Exception
     * @throws TypeError
     */
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



    /**
     * @throws ContainerNotFoundException
     */
    public function grabContainer(): ContainerInterface
    {
        if (!$this->container) {
            throw new ContainerNotFoundException();
        }

        return $this->container;
    }



    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function mock(string $class, callable $callable = null): object
    {
        if (!$callable) {
            /** @psalm-suppress UnusedClosureParam */
            $callable = function (MockInterface $mock): void {};
        }

        /** @var T */
        $mock = Mockery::mock(
            $class,
            $callable
        );

        return $mock;
    }
}
