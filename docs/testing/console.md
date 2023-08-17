---
layout: default
title: Console Actions
parent: Testing
permalink: testing/console
---



# Console Actions

[`Centum\Codeception\Actions\ConsoleActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ConsoleActions.php)

- `createTerminal(array $argv): Centum\Interfaces\Console\TerminalInterface`
- `grabStdoutContent(): string`
- `grabStderrContent(): string`
- `grabConsoleApplication(): Centum\Interfaces\Console\ApplicationInterface`
- `addCommand(string $commandClass): void`
- `runCommand(array $argv): int`
- `grabExitCode(): int`
- `seeExitCodeIs(int $expected): void`
- `seeExitCodeIsNot(int $expected): void`
- `seeStdoutEquals(string $expected): void`
- `seeStdoutNotEquals(string $expected): void`
- `seeStdoutContains(string $expected): void`
- `seeStdoutNotContains(string $expected): void`
- `seeStderrEquals(string $expected): void`
- `seeStderrNotEquals(string $expected): void`
- `seeStderrContains(string $expected): void`
- `seeStderrNotContains(string $expected): void`
- `grabCommandMetadata(string $commandClass): Centum\Console\CommandMetadata`
