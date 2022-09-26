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
- `public function slice(int $offset, int $length): Centum\Interfaces\Paginator\DataInterface`

For data contained within a simple array, [`Centum\Paginator\Data\ArrayData`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Data/ArrayData.php) will suffice.



## Paginating

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) is the main class of the Paginator component.

```php
Centum\Paginator\Paginator(
    Centum\Paginator\DataInterface $data,
    int $itemsPerPage = 10
);
```

{: .highlight }
[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) implements [`Centum\Interfaces\Paginator\PaginatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Paginator/PaginatorInterface.php).

[`Centum\Paginator\Paginator`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Paginator.php) has 4 public methods:

- `public function getData(): Centum\Interfaces\Paginator\DataInterface`
- `public function getTotalItems(): int`
- `public function getItemsPerPage(): int`
- `public functino getTotalPages(): int`
- `public function getPage(int $pageNumber): Centum\Paginator\Page`

`Paginator` is responsible for creating [`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Page.php) objects that represent a page of data.

```php
Centum\Paginator\Page(
    Centum\Paginator\DataInterface $data,
    int $pageNumber,
    int $itemsPerPage = 10
);
```

[`Centum\Paginator\Page`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Page.php) has several public methods:

- `public function getData(): Centum\Interfaces\Paginator\DataInterface`
- `public function getTotalItems(): int`
- `public function getTotalPages(): int`
- `public function getPageNumber(): int`
- `public function getItemsPerPage(): int`
- `public function getStartOffset(): int`
- `public function getEndOffset(): int`
- `public function getPageNumbersBefore(int $max): int`
- `public function getPageNumbersAfter(int $max): int`
- `public function getPreviousPageNumber(): ?int`
- `public function getNextPageNumber(): ?int`



## Example

```php
use Centum\Paginator\DataInterface;
use Centum\Paginator\Paginator;

/** @var DataInterface $data */

$paginator = new Paginator($data);

$page = $paginator->getPage(4);
```

```twig
{% raw %}<ul class="list-group">
    {% for datum in page.getData().toArray() %}
        <li class="list-group-item">
            <!-- display the data -->

            {{ datum }}
        </li>
    {% endfor %}
</ul>

<ul class="pagination">
    {% if page.getPreviousPageNumber() %}
        <li class="page-item">
            <a href="/page/{{ page.getPreviousPageNumber() }}" class="page-link" tabindex="-1">
                Previous
            </a>
        </li>
    {% else %}
        <li class="page-item disabled">
            <a href="#" class="page-link" tabindex="-1">
                Previous
            </a>
        </li>
    {% endif %}

    {% for beforePageNumber in page.getPageNumbersBefore(2) %}
        <li class="page-item">
            <a href="/page/{{ beforePageNumber }}" class="page-link">
                {{ beforePageNumber }}
            </a>
        </li>
    {% endfor %}

    <li class="page-item active">
        <a href="#" class="page-link">
            {{ page.getPageNumber() }}

            <span class="sr-only">(current)</span>
        </a>
    </li>

    {% for afterPageNumber in page.getPageNumbersAfter(2) %}
        <li class="page-item">
            <a href="/page/{{ afterPageNumber }}" class="page-link">
                {{ afterPageNumber }}
            </a>
        </li>
    {% endfor %}

    {% if page.getNextPageNumber() %}
        <li class="page-item">
            <a href="/page/{{ page.getNextPageNumber() }}" class="page-link">
                Next
            </a>
        </li>
    {% else %}
        <li class="page-item disabled">
            <a href="#" class="page-link" tabindex="-1">
                Next
            </a>
        </li>
    {% endif %}
</ul>

(page {{ page.getPageNumber() }} of {{ page.getTotalPages() }}){% endraw %}
```



## Exceptions

(all in the `Centum\Paginator\Exception` namespace)

- [`FileGroupAlreadyExistsException`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Exception/FileGroupAlreadyExistsException.php)
- [`InvalidItemsPerPageException`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Exception/InvalidItemsPerPageException.php)
- [`InvalidMaxException`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Exception/InvalidMaxException.php)
- [`InvalidPageNumberException`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Exception/InvalidPageNumberException.php)
- [`InvalidTotalException`](https://github.com/SidRoberts/centum/blob/development/src/Paginator/Exception/InvalidTotalException.php)
