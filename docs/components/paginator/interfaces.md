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

- `getTotal(): int`
- `toArray(): array`
- `slice(int $offset, int $length): array`



## [`Centum\Interfaces\Paginator\PageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PageInterface.php)

- `getPaginator(): Centum\Interfaces\Paginator\PaginatorInterface`
- `getPageNumber(): int`
- `getData(): array`
- `getPreviousPageNumber(): ?int`
- `getNextPageNumber(): ?int`
- `getPageRange(int $max): array`



## [`Centum\Interfaces\Paginator\PaginatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PaginatorInterface.php)

- `getData(): Centum\Interfaces\Paginator\DataInterface`
- `getItemsPerPage(): int`
- `getUrlPrefix(): string`
- `getTotalItems(): int`
- `getTotalPages(): int`
- `getPage(int $pageNumber): Centum\Interfaces\Paginator\PageInterface`
