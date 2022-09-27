---
layout: default
title: Example
parent: Paginator
grand_parent: Components
permalink: paginator/example
---



# Example

## PHP

```php
use Centum\Paginator\DataInterface;
use Centum\Paginator\Paginator;

/** @var DataInterface $data */

$paginator = new Paginator($data);

$page = $paginator->getPage(4);
```

## Twig template

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
