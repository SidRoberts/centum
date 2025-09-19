---
layout: default
title: Filter
parent: Components
has_children: true
permalink: filter
---



# `Centum\Filter`

Filters are used to transform one value into another.
They are especially useful in validation, allowing you to standardize or sanitize a value before validating it.

{: .note }
All filters must implement [`Centum\Interfaces\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Filter/FilterInterface.php).

Filters only require one public method:

- `filter(mixed $value): mixed`
  Accepts any input and returns the filtered output.

You can leave the return value of `filter()` as `mixed` or you can be more specific, for example:

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



## Links

- [Source code (`src/Filter/`)](https://github.com/SidRoberts/centum/blob/main/src/Filter/)
- [Interfaces (`src/Interfaces/Filter/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Filter/)
- [Unit tests (`tests/Unit/Filter/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Filter/)
