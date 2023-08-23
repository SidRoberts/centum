---
layout: default
title: Interfaces
parent: Flash
grand_parent: Components
permalink: flash/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Flash` namespace)



## [`Centum\Interfaces\Flash\FlashInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FlashInterface.php)

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



## [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FormatterInterface.php)

```php
output(
    Centum\Interfaces\Flash\MessageInterface $message
): string
```



## [`Centum\Interfaces\Flash\MessageBagInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/MessageBagInterface.php)

```php
add(
    Centum\Interfaces\Flash\MessageInterface $message
): void
```

```php
getMessages(): array<Centum\Interfaces\Flash\MessageInterface>
```



## [`Centum\Interfaces\Flash\MessageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/MessageInterface.php)

```php
getLevel(): string
```

```php
getText(): string
```
