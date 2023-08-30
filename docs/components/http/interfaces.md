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

```php
getName(): string
```

```php
getValue(): string
```

```php
getHeaderString(): string
```

```php
send(): void
```

```php
__toString(): string
```



## [`Centum\Interfaces\Http\CookiesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/CookiesInterface.php)

```php
add(
    Centum\Interfaces\Http\CookieInterface $cookie
): void
```

```php
get(
    string $name
): Centum\Interfaces\Http\CookieInterface
```

```php
has(
    string $name
): bool
```

```php
send(): void
```

```php
all(): array<string, Centum\Interfaces\Http\CookieInterface>
```

```php
toArray(): array<string, string>
```



## [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/GeneratorInterface.php)

```php
generate(): string
```



## [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/StorageInterface.php)

```php
get(): string
```

```php
set(
    string $newValue
): void
```

```php
reset(): void
```



## [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/ValidatorInterface.php)

```php
validate(): void
```



## [`Centum\Interfaces\Http\DataInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/DataInterface.php)

```php
get(
    string $name,
    mixed $defaultValue = null
): mixed
```

```php
has(
    string $name
): bool
```

```php
toArray(): array<string, mixed>
```



## [`Centum\Interfaces\Http\FileGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileGroupInterface.php)

```php
getID(): string
```

```php
add(
    Centum\Interfaces\Http\FileInterface $file
): void
```

```php
all(): array<Centum\Interfaces\Http\FileInterface>
```

```php
toArray(): array<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>
```



## [`Centum\Interfaces\Http\FileInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileInterface.php)

```php
getName(): ?string
```

```php
getType(): ?string
```

```php
getSize(): int
```

```php
getLocation(): ?string
```

```php
getError(): int
```

```php
isMoved(): bool
```

```php
validate(): void
```

```php
getExtension(): ?string
```

```php
moveTo(
    string $path
): bool
```

```php
toArray(): array{name: ?string, type: ?string, size: int, location: ?string, error: int}
```



## [`Centum\Interfaces\Http\FilesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FilesInterface.php)

```php
add(
    Centum\Interfaces\Http\FileGroupInterface $fileGroup
): void
```

```php
has(
    string $id
): bool
```

```php
get(
    string $id
): Centum\Interfaces\Http\FileGroupInterface
```

```php
all(): array<string, Centum\Interfaces\Http\FileGroupInterface>
```

```php
toArray(): array<string, array<array{name: ?string, type: ?string, size: int, location: ?string, error: int}>>
```



## [`Centum\Interfaces\Http\FormInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FormInterface.php)

No methods.



## [`Centum\Interfaces\Http\HeaderInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeaderInterface.php)

```php
getName(): string
```

```php
getValue(): string
```

```php
getHeaderString(): string
```

```php
send(): void
```

```php
__toString(): string
```



## [`Centum\Interfaces\Http\HeadersInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/HeadersInterface.php)

```php
add(
    Centum\Interfaces\Http\HeaderInterface $header
): void
```

```php
addMultiple(
    array<Centum\Interfaces\Http\HeaderInterface> $headers
): void
```

```php
get(
    string $name
): Centum\Interfaces\Http\HeaderInterface
```

```php
has(
    string $name
): bool
```

```php
matches(
    string $name,
    string $value
): bool
```

```php
send(): void
```

```php
all(): array<string, Centum\Interfaces\Http\HeaderInterface>
```

```php
toArray(): array<string, string>
```



## [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php)

```php
getUri(): string
```

```php
getMethod(): string
```

```php
getData(): Centum\Interfaces\Http\DataInterface
```

```php
getHeaders(): Centum\Interfaces\Http\HeadersInterface
```

```php
getCookies(): Centum\Interfaces\Http\CookiesInterface
```

```php
getFiles(): Centum\Interfaces\Http\FilesInterface
```

```php
getContent(): ?string
```



## [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/ResponseInterface.php)

```php
getContent(): string
```

```php
getStatus(): Centum\Http\Status
```

```php
getHeaders(): Centum\Interfaces\Http\HeadersInterface
```

```php
getCookies(): Centum\Interfaces\Http\CookiesInterface
```

```php
sendHeaders(): void
```

```php
sendContent(): void
```

```php
send(): void
```

```php
getRaw(): string
```

```php
__toString(): string
```



## [`Centum\Interfaces\Http\SessionInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/SessionInterface.php)

```php
start(): bool
```

```php
isActive(): bool
```

```php
has(
    string $name
): bool
```

```php
get(
    string $name,
    mixed $defaultValue = null
): mixed
```

```php
set(
    string $name,
    mixed $value
): void
```

```php
remove(
    string $name
): void
```

```php
clear(): void
```

```php
all(): array<string, mixed>
```
