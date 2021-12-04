<?php

namespace Centum\Http\Session;

class SessionGlobalVariableHandler implements HandlerInterface
{
    public function start(): bool
    {
        return session_start();
    }

    public function isActive(): bool
    {
        return session_status() === \PHP_SESSION_ACTIVE;
    }



    public function has(string $name): bool
    {
        if (!$this->isActive()) {
            $this->start();
        }

        return isset($_SESSION[$name]);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        if (!$this->isActive()) {
            $this->start();
        }

        return $_SESSION[$name] ?? $defaultValue;
    }

    public function set(string $name, mixed $value): void
    {
        if (!$this->isActive()) {
            $this->start();
        }

        /**
         * @var mixed
         */
        $_SESSION[$name] = $value;
    }

    public function remove(string $name): void
    {
        if (!$this->isActive()) {
            $this->start();
        }

        unset($_SESSION[$name]);
    }

    public function clear(): void
    {
        if (!$this->isActive()) {
            $this->start();
        }

        $_SESSION = [];
    }

    public function all(): array
    {
        if (!$this->isActive()) {
            $this->start();
        }

        /**
         * @var array<array-key, mixed>
         */
        return $_SESSION;
    }
}
