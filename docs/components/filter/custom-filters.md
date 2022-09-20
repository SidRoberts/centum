---
layout: default
title: Custom Filters
parent: Filter
grand_parent: Components
permalink: filter/custom-filters
---



# Custom Filters

Filters must implement [`Centum\Filter\FilterInterface`](https://github.com/SidRoberts/centum/tree/development/src/Filter/FilterInterface.php) and implement the following methods:

- `public function filter(mixed $value): mixed`.

As an example, a Filter can be made to return a string as lowercase:

```php
use Centum\Filter\FilterInterface;

class LowercaseFilter implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        return strtolower($value);
    }
}
```

(see also [`Centum\Filter\String\ToLower`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/ToLower.php)).

More complex Filters can be made by injecting other objects into the filter:

```php
use Centum\Filter\FilterInterface;
use NumberFormatter;

class NumberFormatterFilter implements FilterInterface
{
    protected NumberFormatter $numberFormatter;

    public function __construct(NumberFormatter $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    public function filter(mixed $value): mixed
    {
        return $this->numberFormatter->format($value);
    }
}
```
