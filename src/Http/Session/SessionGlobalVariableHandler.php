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
        return isset($_SESSION[$name]);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $_SESSION[$name] ?? $defaultValue;
    }

    public function set(string $name, mixed $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function remove(string $name): void
    {
        unset($_SESSION[$name]);
    }

    public function clear(): void
    {
        $_SESSION = [];
    }

    public function all(): array
    {
        return $_SESSION;
    }
}
