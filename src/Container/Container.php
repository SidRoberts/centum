<?php

namespace Centum\Container;

use Centum\Access\Access;
use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Container\Exception\InstantiateInterfaceException;
use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Cron\Cron;
use Centum\Flash\Flash;
use Centum\Http\Csrf\Generator;
use Centum\Http\Csrf\Storage;
use Centum\Http\Csrf\Validator;
use Centum\Http\Request;
use Centum\Http\Session\GlobalSession;
use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Flash\FlashInterface;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Interfaces\Url\UrlInterface;
use Centum\Router\Router;
use Centum\Url\Url;
use Closure;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;

class Container implements ContainerInterface
{
    /** @var array<interface-string, object> */
    protected array $objects = [];

    /** @var array<interface-string, class-string> */
    protected array $aliases = [
        AccessInterface::class      => Access::class,
        ApplicationInterface::class => Application::class,
        CronInterface::class        => Cron::class,
        GeneratorInterface::class   => Generator::class,
        StorageInterface::class     => Storage::class,
        ValidatorInterface::class   => Validator::class,
        FlashInterface::class       => Flash::class,
        RequestInterface::class     => Request::class,
        RouterInterface::class      => Router::class,
        SessionInterface::class     => GlobalSession::class,
        UrlInterface::class         => Url::class,
        TerminalInterface::class    => Terminal::class,
    ];



    public function __construct()
    {
        $this->set(ContainerInterface::class, $this);
    }



    /**
     * @template T of object
     * @psalm-param interface-string<T>|class-string<T> $class
     * @psalm-return T
     */
    public function get(string $class): object
    {
        if (!isset($this->objects[$class])) {
            $alias = $this->aliases[$class] ?? $class;

            if (interface_exists($alias)) {
                throw new InstantiateInterfaceException($alias);
            }

            $reflectionClass = new ReflectionClass($alias);

            if ($reflectionClass->hasMethod("__construct")) {
                $reflectionMethod = $reflectionClass->getMethod("__construct");

                $params = $this->resolveParams($reflectionMethod);

                $this->objects[$class] = $reflectionClass->newInstanceArgs($params);
            } else {
                $this->objects[$class] = $reflectionClass->newInstance();
            }
        }

        /** @psalm-var T */
        return $this->objects[$class];
    }



    public function typehintMethod(object $class, string $methodName): mixed
    {
        $reflectionMethod = new ReflectionMethod($class, $methodName);

        $params = $this->resolveParams($reflectionMethod);

        return $reflectionMethod->invokeArgs($class, $params);
    }



    /**
     * @param Closure|callable-string $function
     */
    public function typehintFunction(Closure | string $function): mixed
    {
        $reflectionFunction = new ReflectionFunction($function);

        $params = $this->resolveParams($reflectionFunction);

        return $reflectionFunction->invokeArgs($params);
    }



    /**
     * @param interface-string $interface
     * @param class-string $alias
     */
    public function addAlias(string $interface, string $alias): void
    {
        $this->aliases[$interface] = $alias;
    }



    /**
     * @param interface-string $interface
     */
    public function set(string $interface, object $object): void
    {
        $this->objects[$interface] = $object;
    }

    /**
     * @param interface-string $interface
     * @param Closure|callable-string $function
     */
    public function setDynamic(string $interface, Closure | string $function): void
    {
        /** @var object */
        $object = $this->typehintFunction($function);

        $this->objects[$interface] = $object;
    }

    /**
     * @param interface-string $interface
     */
    public function remove(string $interface): void
    {
        unset($this->objects[$interface]);
    }



    /**
     * @return array<int<0, max>, mixed>
     */
    protected function resolveParams(ReflectionFunctionAbstract $method): array
    {
        $parameters = $method->getParameters();

        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            /** @var mixed */
            $resolvedParameters[] = $this->resolveParam($parameter);
        }

        return $resolvedParameters;
    }

    protected function resolveParam(ReflectionParameter $parameter): mixed
    {
        $type = $parameter->getType();

        if ($type === null && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        if (!($type instanceof ReflectionNamedType)) {
            $name = $parameter->getName();

            throw new UnresolvableParameterException($name);
        }

        if ($type->isBuiltIn()) {
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if ($parameter->allowsNull()) {
                return null;
            }

            $name = $parameter->getName();

            throw new UnresolvableParameterException($name);
        }

        $class = $type->getName();

        return $this->get($class);
    }
}
