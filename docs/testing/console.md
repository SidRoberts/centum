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
- `addCommand(Centum\Interfaces\Console\CommandInterface $command): void`
- `runCommand(array $argv): int`
- `grabExitCode(): int`
- `seeExitCodeIs(int $exitCode, string $message = ""): void`
- `seeExitCodeIsNot(int $exitCode, string $message = ""): void`
- `seeStdoutEquals(string $expected, string $message = ""): void`
- `seeStdoutNotEquals(string $expected, string $message = ""): void`
- `seeStdoutContains(string $expected, string $message = ""): void`
- `seeStdoutNotContains(string $expected, string $message = ""): void`
- `seeStderrEquals(string $expected, string $message = ""): void`
- `seeStderrNotEquals(string $expected, string $message = ""): void`
- `seeStderrContains(string $expected, string $message = ""): void`
- `seeStderrNotContains(string $expected, string $message = ""): void`
