---
layout: default
title: Paginator
parent: Components
has_children: true
permalink: paginator
---



# `Centum\Paginator`

The Paginator component is used for paginating large amounts of data practically.



## How data is stored

Data is encapsulated in a class implementing [`Centum\Interfaces\Paginator\DataInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/DataInterface.php).
It is designed such that the entire dataset can be contained within a `DataInterface` object or can be retreived as and when it is needed.

[`DataInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/DataInterface.php) has 3 public methods:

- `public function getTotal(): int`
- `public function toArray(): array`
- `public function slice(int $offset, int $length): array`

For data contained within a simple array, [`Centum\Paginator\Data\ArrayData`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Data/ArrayData.php) will suffice.



## Paginating

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) is the main class of the Paginator component.

```php
Centum\Paginator\Paginator(
    Centum\Interfaces\Paginator\DataInterface $data,
    int $itemsPerPage,
    string $urlPrefix
);
```

{: .highlight }
[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) implements [`Centum\Interfaces\Paginator\PaginatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PaginatorInterface.php).

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) has 6 public methods:

- `public function getData(): Centum\Interfaces\Paginator\DataInterface`
- `public function getItemsPerPage(): int`
- `public function getUrlPrefix(): string`
- `public function getTotalItems(): int`
- `public function getTotalPages(): int`
- `public function getPage(int $pageNumber): Centum\Interfaces\Paginator\PageInterface`

`Paginator` is responsible for creating [`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Page.php) objects that represent a page of data.

```php
Centum\Paginator\Page(
    Centum\Interfaces\Paginator\PaginatorInterface $paginator,
    int $pageNumber
);
```

{: .highlight }
[`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Page.php) implements [`Centum\Interfaces\Paginator\PageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PageInterface.php).

[`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Page.php) has several public methods:

- `public function getPaginator(): Centum\Interfaces\Paginator\PaginatorInterface`
- `public function getPageNumber(): int`
- `public function getData(): array`
- `public function getPreviousPageNumber(): int|null`
- `public function getNextPageNumber(): int|null`
- `public function getPageRange(int $i): array`
