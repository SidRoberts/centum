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
use Symfony\Component\BrowserKit\AbstractBrowser;
use TypeError;

class Module extends CodeceptionModule
{
    /**
     * @var array<string, string>
     *
     * @psalm-suppress all
     */
    protected array $config = [
        "container" => "config/container.php",
    ];

    protected ?ContainerInterface $container = null;



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



    public function grabContainer(): ContainerInterface
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
        $container = $this->grabContainer();

        $container->set($class, $object);
    }

    /**
     * @template T
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    public function grabFromContainer(string $class): object
    {
        $container = $this->grabContainer();

        return $container->get($class);
    }



    /**
     * @template T
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    public function mock(string $class, callable $callable = null): object
    {
        if (!$callable) {
            /** @psalm-suppress UnusedClosureParam */
            $callable = function (MockInterface $mock): void {};
        }

        /** @psalm-var T */
        $mock = Mockery::mock(
            $class,
            $callable
        );

        return $mock;
    }

    /**
     * @template T
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    public function mockInContainer(string $class, callable $callable = null): object
    {
        $container = $this->grabContainer();

        $mock = $this->mock($class, $callable);

        $container->set($class, $mock);

        return $mock;
    }
}
