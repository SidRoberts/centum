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

- `success(string $text): void`
- `info(string $text): void`
- `warning(string $text): void`
- `danger(string $text): void`
- `output(): string`



## [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/FormatterInterface.php)

- `output(Centum\Interfaces\Flash\MessageInterface $message): string`



## [`Centum\Interfaces\Flash\MessageBagInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/MessageBagInterface.php)

- `add(Centum\Interfaces\Flash\MessageInterface $message): void`
- `getMessages(): array`



## [`Centum\Interfaces\Flash\MessageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Flash/MessageInterface.php)

- `getLevel(): string`
- `getText(): string`
