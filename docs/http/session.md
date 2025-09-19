---
layout: default
title: Session
parent: Http Component
permalink: http/session
nav_order: 2
---



# Session

Sessions allow you to persist data across multiple requests for individual users.
Common use cases include storing login status, user preferences, and temporary data.

Centum provides session classes that abstract session management, making it easy to interact with session data.

{: .callout.info }
All session classes implement [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/SessionInterface.php).

`SessionInterface` defines the following public methods:

- `start(): bool`
- `isActive(): bool`
- `has(string $name): bool`
- `get(string $name, mixed $defaultValue = null): mixed`
- `set(string $name, mixed $value): void`
- `remove(string $name): void`
- `clear(): void`
- `all(): array`



## Available Implementations

Centum provides different session implementations to suit various needs:

- [`Centum\Http\Session\ArraySession`](https://github.com/SidRoberts/centum/blob/main/src/Http/Session/ArraySession.php) — Stores session data in memory (useful for testing).
- [`Centum\Http\Session\GlobalSession`](https://github.com/SidRoberts/centum/blob/main/src/Http/Session/GlobalSession.php) — Uses PHP's global `$_SESSION` array.
