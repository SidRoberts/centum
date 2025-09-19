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

Data is encapsulated in a class implementing [`Centum\Interfaces\Paginator\DataInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Paginator/DataInterface.php).
It is designed such that the entire dataset can be contained within a `DataInterface` object or can be retreived as and when it is needed.

[`DataInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Paginator/DataInterface.php) has 3 public methods:

- `getTotal(): int`
- `toArray(): array`
- `slice(int $offset, int $length): array`

For data contained within a simple array, [`Centum\Paginator\Data\ArrayData`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Data/ArrayData.php) will suffice.



## Paginating

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Paginator.php) is the main class of the Paginator component.

```php
Centum\Paginator\Paginator(
    Centum\Interfaces\Paginator\DataInterface $data,
    int $itemsPerPage,
    string $urlPrefix
);
```

{: .highlight }
[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Paginator.php) implements [`Centum\Interfaces\Paginator\PaginatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Paginator/PaginatorInterface.php).

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Paginator.php) has 6 public methods:

- `getData(): Centum\Interfaces\Paginator\DataInterface`
- `getItemsPerPage(): int`
- `getUrlPrefix(): string`
- `getTotalItems(): int`
- `getTotalPages(): int`
- `getPage(int $pageNumber): Centum\Interfaces\Paginator\PageInterface`

`Paginator` is responsible for creating [`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Page.php) objects that represent a page of data.

```php
Centum\Paginator\Page(
    Centum\Interfaces\Paginator\PaginatorInterface $paginator,
    int $pageNumber
);
```

{: .highlight }
[`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Page.php) implements [`Centum\Interfaces\Paginator\PageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Paginator/PageInterface.php).

[`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/main/src/Paginator/Page.php) has several public methods:

- `getPaginator(): Centum\Interfaces\Paginator\PaginatorInterface`
- `getPageNumber(): int`
- `getData(): array`
- `getPreviousPageNumber(): int|null`
- `getNextPageNumber(): int|null`
- `getPageRange(int $i): array`



## Links

- [Source code (`src/Paginator/`)](https://github.com/SidRoberts/centum/blob/main/src/Paginator/)
- [Interfaces (`src/Interfaces/Paginator/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Paginator/)
- [Unit tests (`tests/Unit/Paginator/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Paginator/)
