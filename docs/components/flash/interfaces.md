---
layout: default
title: Interfaces
parent: Flash Component
permalink: flash/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Flash` namespace)



## [`FlashInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FlashInterface.php)

```php
success(
    string $text
): void
```

```php
info(
    string $text
): void
```

```php
warning(
    string $text
): void
```

```php
danger(
    string $text
): void
```

```php
output(): string
```



## [`FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php)

```php
output(
    Centum\Interfaces\Flash\MessageInterface $message
): string
```



## [`MessageBagInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/MessageBagInterface.php)

```php
add(
    Centum\Interfaces\Flash\MessageInterface $message
): void
```

```php
getMessages(): array<Centum\Interfaces\Flash\MessageInterface>
```



## [`MessageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/MessageInterface.php)

```php
getLevel(): non-empty-string
```

```php
getText(): string
```



## [`StorageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/StorageInterface.php)

```php
get(): Centum\Interfaces\Flash\MessageBagInterface
```

```php
set(
    Centum\Interfaces\Flash\MessageBagInterface $messageBag
): void
```

```php
reset(): void
```
