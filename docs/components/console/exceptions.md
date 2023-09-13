---
layout: default
title: Exceptions
parent: Console
grand_parent: Components
permalink: console/exceptions
nav_order: 101
---



# Exceptions

(all in the `Centum\Console\Exception` namespace)



## [`ArgvNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/ArgvNotFoundException.php)

Thrown in:

- [`Centum\App\ConsoleBootstrap::boot()`](https://github.com/SidRoberts/centum/blob/development/src/App/ConsoleBootstrap.php#L21)
- [`Centum\App\ConsoleBootstrap::getTerminal()`](https://github.com/SidRoberts/centum/blob/development/src/App/ConsoleBootstrap.php#L33)



## [`CommandMetadataNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandMetadataNotFoundException.php)

Thrown in:

- [`Centum\Console\Application::__construct()`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php#L36)
- [`Centum\Console\Application::getCommandMetadata()`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php#L50)
- [`Centum\Console\Application::addCommand()`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php#L70)



## [`CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php)

Thrown in:

- [`Centum\Console\Application::handle()`](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php#L97)



## [`InvalidCommandNameException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/InvalidCommandNameException.php)

Thrown in:

- [`Centum\Console\CommandMetadata::__construct()`](https://github.com/SidRoberts/centum/blob/development/src/Console/CommandMetadata.php#L14)



## [`UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/UnsuitableExceptionHandlerException.php)

No Centum classes throw `Centum\Console\Exception\UnsuitableExceptionHandlerException`.
