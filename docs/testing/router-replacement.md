---
layout: default
title: Router Replacement Actions
parent: Testing
permalink: testing/router-replacement
---



# Router Replacement Actions

[`Centum\Codeception\Actions\RouterReplacementActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterReplacementActions.php)

- `assertRouterReplacementMatches(Centum\Interfaces\Router\ReplacementInterface $replacement, string $value): void`
- `assertRouterReplacementDoesNotMatch(Centum\Interfaces\Router\ReplacementInterface $replacement, string $value): void`
- `assertRouterReplacementFilterEquals(Centum\Interfaces\Router\ReplacementInterface $replacement, string $input, mixed $expectedOutput): void`
- `assertRouterReplacementFilterDoesNotEqual(Centum\Interfaces\Router\ReplacementInterface $replacement, string $input, mixed $expectedOutput): void`
