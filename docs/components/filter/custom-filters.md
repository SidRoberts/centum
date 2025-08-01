---
layout: default
title: Custom Filters
parent: Filter
grand_parent: Components
permalink: filter/custom-filters
nav_order: 2
---



# Custom Filters

{: .note }
Filters must implement [`Centum\Interfaces\Filter\FilterInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Filter/FilterInterface.php).

Filters only require one public method:

- `public function filter(mixed $value): mixed`
  Accepts any input and returns the filtered output.



## Example: Lowercase Filter

A simple filter that converts a string to lowercase:

```php
namespace App\Filters;

use Centum\Interfaces\Filter\FilterInterface;

class LowercaseFilter implements FilterInterface
{
    public function filter(mixed $value): mixed
    {
        return mb_strtolower($value);
    }
}
```

See also [`Centum\Filter\String\ToLower`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/ToLower.php) for a built-in implementation.



## Example: Filter with Dependency Injection

You can create more advanced filters by injecting dependencies, such as services or formatters:

```php
namespace App\Filters;

use Centum\Interfaces\Filter\FilterInterface;
use NumberFormatter;

class NumberFormatterFilter implements FilterInterface
{
    public function __construct(
        protected readonly NumberFormatter $numberFormatter
    ) {
    }

    public function filter(mixed $value): mixed
    {
        return $this->numberFormatter->format($value);
    }
}
```



## Usage

Custom filters can be used anywhere you need to transform or sanitize data, such as before validation or storage.

```php
$filter = new \App\Filters\LowercaseFilter();

$result = $filter->filter("HELLO WORLD"); // "hello world"
```
