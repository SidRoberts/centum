---
layout: default
title: Example
parent: Paginator
grand_parent: Components
permalink: paginator/example
nav_order: 1
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
    {% for datum in page.getData() %}
        <li class="list-group-item">
            <!-- display the data -->

            {{ datum }}
        </li>
    {% endfor %}
</ul>

{% if page.getPaginator().getTotalPages() > 1 %}
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            {% if page.getPreviousPageNumber() %}
                <li class="page-item">
                    <a href="{{ page.getPaginator().getUrlPrefix() ~ page.getPreviousPageNumber()|escape("html_attr") }}" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            {% else %}
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </span>
                </li>
            {% endif %}

            {% for paginationPageNumber in page.getPageRange(2) %}
                <li class="page-item">
                    <a href="{{ page.getPaginator().getUrlPrefix() ~ paginationPageNumber|escape("html_attr") }}" class="page-link {% if paginationPageNumber == page.getPageNumber() %}active{% endif %}">
                        {{ paginationPageNumber|escape("html") }}
                    </a>
                </li>
            {% endfor %}

            {% if page.getNextPageNumber() %}
                <li class="page-item">
                    <a href="{{ page.getPaginator().getUrlPrefix() ~ page.getNextPageNumber()|escape("html_attr") }}" class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            {% else %}
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </span>
                </li>
            {% endif %}
        </ul>
    </nav>
{% endif %}{% endraw %}
```
