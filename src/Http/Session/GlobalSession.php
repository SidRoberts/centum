<?php

namespace Centum\Http\Session;

use Centum\Interfaces\Http\SessionInterface;

class GlobalSession implements SessionInterface
{
    public function start(): bool
    {
        return session_start();
    }

    public function startIfNotActive(): bool
    {
        if ($this->isActive()) {
            return true;
        }

        return $this->start();
    }

    public function isActive(): bool
    {
        return session_status() === \PHP_SESSION_ACTIVE;
    }



    public function has(string $name): bool
    {
        $this->startIfNotActive();

        return isset($_SESSION[$name]);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        $this->startIfNotActive();

        return $_SESSION[$name] ?? $defaultValue;
    }

    public function set(string $name, mixed $value): void
    {
        $this->startIfNotActive();

        /** @var mixed */
        $_SESSION[$name] = $value;
    }

    public function remove(string $name): void
    {
        $this->startIfNotActive();

        unset($_SESSION[$name]);
    }

    public function clear(): void
    {
        $this->startIfNotActive();

        $_SESSION = [];
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        $this->startIfNotActive();

        /** @var array<string, mixed> */
        return $_SESSION;
    }
}
