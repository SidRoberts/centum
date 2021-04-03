<?php

namespace Centum\Http;

use Centum\Http\Session\HandlerInterface;
use Centum\Http\Session\SessionGlobalVariableHandler;

class Session
{
    protected HandlerInterface $handler;



    public function __construct(HandlerInterface $handler = null)
    {
        $this->handler = $handler ?? new SessionGlobalVariableHandler();
    }



    public function start(): bool
    {
        return $this->handler->start();
    }

    public function isActive(): bool
    {
        return $this->handler->isActive();
    }



    public function has(string $name): bool
    {
        return $this->handler->has($name);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->handler->get($name, $defaultValue);
    }

    public function set(string $name, mixed $value): void
    {
        $this->handler->set($name, $value);
    }

    public function remove(string $name): void
    {
        $this->handler->remove($name);
    }

    public function clear(): void
    {
        $this->handler->clear();
    }

    public function all(): array
    {
        return $this->handler->all();
    }
}
