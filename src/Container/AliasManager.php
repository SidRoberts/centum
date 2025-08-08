<?php

namespace Centum\Container;

use Centum\Access\Access;
use Centum\Console\Application;
use Centum\Console\Terminal;
use Centum\Cron\Cron;
use Centum\Flash\Flash;
use Centum\Flash\Formatter\HtmlFormatter;
use Centum\Flash\Storage as FlashStorage;
use Centum\Http\Csrf\Generator;
use Centum\Http\Csrf\Storage;
use Centum\Http\Csrf\Validator;
use Centum\Http\Request;
use Centum\Http\Session\GlobalSession;
use Centum\Interfaces\Access\AccessInterface;
use Centum\Interfaces\Console\ApplicationInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\AliasManagerInterface;
use Centum\Interfaces\Cron\CronInterface;
use Centum\Interfaces\Flash\FlashInterface;
use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\StorageInterface as FlashStorageInterface;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Interfaces\Queue\TaskRunnerInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Interfaces\Translation\TranslatorInterface;
use Centum\Interfaces\Url\UrlInterface;
use Centum\Queue\TaskRunner;
use Centum\Router\Router;
use Centum\Translation\Translator;
use Centum\Url\Url;

class AliasManager implements AliasManagerInterface
{
    /**
     * @var array<class-string, class-string>
     */
    protected array $aliases = [
        AccessInterface::class       => Access::class,
        ////////////////////////////////////////////////////////////////////////
        ApplicationInterface::class  => Application::class,
        TerminalInterface::class     => Terminal::class,
        ////////////////////////////////////////////////////////////////////////
        CronInterface::class         => Cron::class,
        ////////////////////////////////////////////////////////////////////////
        GeneratorInterface::class    => Generator::class,
        StorageInterface::class      => Storage::class,
        ValidatorInterface::class    => Validator::class,
        ////////////////////////////////////////////////////////////////////////
        FlashInterface::class        => Flash::class,
        FormatterInterface::class    => HtmlFormatter::class,
        FlashStorageInterface::class => FlashStorage::class,
        ////////////////////////////////////////////////////////////////////////
        RequestInterface::class      => Request::class,
        SessionInterface::class      => GlobalSession::class,
        ////////////////////////////////////////////////////////////////////////
        TaskRunnerInterface::class   => TaskRunner::class,
        ////////////////////////////////////////////////////////////////////////
        RouterInterface::class       => Router::class,
        ////////////////////////////////////////////////////////////////////////
        TranslatorInterface::class   => Translator::class,
        ////////////////////////////////////////////////////////////////////////
        UrlInterface::class          => Url::class,
    ];



    public function add(string $class, string $alias): void
    {
        $this->aliases[$class] = $alias;
    }

    public function get(string $class): string
    {
        return $this->aliases[$class] ?? $class;
    }

    public function has(string $class): bool
    {
        return isset($this->aliases[$class]);
    }

    public function remove(string $class): void
    {
        unset($this->aliases[$class]);
    }



    public function getAll(): array
    {
        return $this->aliases;
    }
}
