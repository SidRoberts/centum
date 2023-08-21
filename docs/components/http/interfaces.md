---
layout: default
title: Interfaces
parent: Http
grand_parent: Components
permalink: http/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Http` namespace)



## [`Centum\Interfaces\Http\CookieInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookieInterface.php)

- `getName(): string`
- `getValue(): string`
- `getHeaderString(): string`
- `send(): void`
- `__toString(): string`



## [`Centum\Interfaces\Http\CookiesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookiesInterface.php)

- `add(Centum\Interfaces\Http\CookieInterface $cookie): void`
- `get(string $name): Centum\Interfaces\Http\CookieInterface`
- `has(string $name): bool`
- `send(): void`
- `all(): array`
- `toArray(): array`



## [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/GeneratorInterface.php)

- `generate(): string`



## [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/StorageInterface.php)

- `get(): string`
- `set(string $newValue): void`
- `reset(): void`



## [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/ValidatorInterface.php)

- `validate(): void`



## [`Centum\Interfaces\Http\DataInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/DataInterface.php)

- `get(string $name, mixed $defaultValue = null): mixed`
- `has(string $name): bool`
- `toArray(): array`



## [`Centum\Interfaces\Http\FileGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileGroupInterface.php)

- `getID(): string`
- `add(Centum\Interfaces\Http\FileInterface $file): void`
- `all(): array`
- `toArray(): array`



## [`Centum\Interfaces\Http\FileInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileInterface.php)

- `getName(): ?string`
- `getType(): ?string`
- `getSize(): int`
- `getLocation(): ?string`
- `getError(): int`
- `isMoved(): bool`
- `validate(): void`
- `getExtension(): ?string`
- `moveTo(string $path): bool`
- `toArray(): array`



## [`Centum\Interfaces\Http\FilesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FilesInterface.php)

- `add(Centum\Interfaces\Http\FileGroupInterface $fileGroup): void`
- `has(string $id): bool`
- `get(string $id): Centum\Interfaces\Http\FileGroupInterface`
- `all(): array`
- `toArray(): array`



## [`Centum\Interfaces\Http\FormInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FormInterface.php)



## [`Centum\Interfaces\Http\HeaderInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeaderInterface.php)

- `getName(): string`
- `getValue(): string`
- `getHeaderString(): string`
- `send(): void`
- `__toString(): string`



## [`Centum\Interfaces\Http\HeadersInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeadersInterface.php)

- `add(Centum\Interfaces\Http\HeaderInterface $header): void`
- `addMultiple(array $headers): void`
- `get(string $name): Centum\Interfaces\Http\HeaderInterface`
- `has(string $name): bool`
- `matches(string $name, string $value): bool`
- `send(): void`
- `all(): array`
- `toArray(): array`



## [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php)

- `getUri(): string`
- `getMethod(): string`
- `getData(): Centum\Interfaces\Http\DataInterface`
- `getHeaders(): Centum\Interfaces\Http\HeadersInterface`
- `getCookies(): Centum\Interfaces\Http\CookiesInterface`
- `getFiles(): Centum\Interfaces\Http\FilesInterface`
- `getContent(): ?string`



## [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/ResponseInterface.php)

- `getContent(): string`
- `getStatus(): Centum\Http\Status`
- `getHeaders(): Centum\Interfaces\Http\HeadersInterface`
- `getCookies(): Centum\Interfaces\Http\CookiesInterface`
- `sendHeaders(): void`
- `sendContent(): void`
- `send(): void`
- `getRaw(): string`
- `__toString(): string`



## [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/SessionInterface.php)

- `start(): bool`
- `isActive(): bool`
- `has(string $name): bool`
- `get(string $name, mixed $defaultValue = null): mixed`
- `set(string $name, mixed $value): void`
- `remove(string $name): void`
- `clear(): void`
- `all(): array`
