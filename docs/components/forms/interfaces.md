---
layout: default
title: Interfaces
parent: Forms
grand_parent: Components
permalink: forms/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Forms` namespace)



## [`Centum\Interfaces\Forms\FieldInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Forms/FieldInterface.php)

- `getName(): string`
- `getFilters(): array`
- `getValidators(): array`
- `addFilter(Centum\Interfaces\Filter\FilterInterface $filter): void`
- `addValidator(Centum\Interfaces\Validator\ValidatorInterface $validator): void`
- `getFilteredValue(mixed $value): mixed`
- `isValid(mixed $value): bool`
- `getMessages(mixed $value): array`



## [`Centum\Interfaces\Forms\FormInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Forms/FormInterface.php)

- `add(Centum\Interfaces\Forms\FieldInterface $field): void`
- `getFilteredValues(array $data): array`
- `validate(array $data): Centum\Interfaces\Forms\StatusInterface`



## [`Centum\Interfaces\Forms\StatusInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Forms/StatusInterface.php)

- `isValid(): bool`
- `getMessages(): array`
