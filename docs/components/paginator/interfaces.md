---
layout: default
title: Interfaces
parent: Paginator
grand_parent: Components
permalink: paginator/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Paginator` namespace)



## [`Centum\Interfaces\Paginator\DataInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/DataInterface.php)

```php
getTotal(): non-negative-int
```

```php
toArray(): array<mixed>
```

```php
slice(
    int $offset,
    int $length
): array<mixed>
```



## [`Centum\Interfaces\Paginator\PageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PageInterface.php)

```php
getPaginator(): Centum\Interfaces\Paginator\PaginatorInterface
```

```php
getPageNumber(): positive-int
```

```php
getData(): array<mixed>
```

```php
getPreviousPageNumber(): positive-int|null
```

```php
getNextPageNumber(): positive-int|null
```

```php
getPageRange(
    positive-int $max
): list<positive-int>
```



## [`Centum\Interfaces\Paginator\PaginatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PaginatorInterface.php)

```php
getData(): Centum\Interfaces\Paginator\DataInterface
```

```php
getItemsPerPage(): int
```

```php
getUrlPrefix(): string
```

```php
getTotalItems(): non-negative-int
```

```php
getTotalPages(): positive-int
```

```php
getPage(
    positive-int $pageNumber
): Centum\Interfaces\Paginator\PageInterface
```
