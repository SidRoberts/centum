---
layout: default
title: Forms Interfaces
parent: Forms Component
permalink: forms/interfaces
nav_order: 102
---



# Forms Interfaces

(all in the `Centum\Interfaces\Forms` namespace)



## [`FieldInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/FieldInterface.php)

```php
getName(): non-empty-string
```

```php
getFilters(): array<Centum\Interfaces\Filter\FilterInterface>
```

```php
getValidators(): array<Centum\Interfaces\Validator\ValidatorInterface>
```

```php
addFilter(
    Centum\Interfaces\Filter\FilterInterface $filter
): void
```

```php
addValidator(
    Centum\Interfaces\Validator\ValidatorInterface $validator
): void
```

```php
getFilteredValue(
    mixed $value
): mixed
```

```php
isValid(
    mixed $value
): bool
```

```php
getMessages(
    mixed $value
): array<non-empty-string>
```



## [`FormInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/FormInterface.php)

```php
add(
    Centum\Interfaces\Forms\FieldInterface $field
): void
```

```php
getFilteredValues(
    array<string, mixed> $data
): array<string, mixed>
```

```php
validate(
    array<string, mixed> $data
): Centum\Interfaces\Forms\StatusInterface
```



## [`StatusInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Forms/StatusInterface.php)

```php
isValid(): bool
```

```php
getMessages(): array<non-empty-string, array<non-empty-string>>
```
