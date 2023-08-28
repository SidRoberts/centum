---
layout: default
title: Validator Actions
parent: Testing
permalink: testing/validator
---



# Validator Actions

[`Centum\Codeception\Actions\ValidatorActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ValidatorActions.php)



## `seeValidatorPasses`

```php
seeValidatorPasses(
    Centum\Interfaces\Validator\ValidatorInterface $validator,
    mixed $value
): void
```



## `seeValidatorFails`

```php
seeValidatorFails(
    Centum\Interfaces\Validator\ValidatorInterface $validator,
    mixed $value,
    list<string>|null $expectedViolations = null
): void
```
