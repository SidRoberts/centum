---
layout: default
title: Filter
parent: Components
has_children: true
permalink: filter
---



# `Centum\Filter`

Filters are used to transform one value into another.
They are very useful in validation as it allows you to standardise a value before validating it.

{: .highlight }
All filters implement [`Centum\Interfaces\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Filter/FilterInterface.php).

Filters must implement one public method:

- `filter(mixed $value): mixed`

The `filter()` method takes an input of any data type and return a filtered output of any type.
You can leave the return value as `mixed` or you can be more specific, for example:

```php
namespace App\Filters;

use Centum\Interfaces\Filter\FilterInterface;

class ArrayFilter implements FilterInterface
{
    public function filter(mixed $value): array
    {
        return [$value];
    }
}
```
