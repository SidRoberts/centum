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
use Centum\Interfaces\Filter\FilterInterface;

class ArrayFilter implements FilterInterface
{
    public function filter(mixed $value): array
    {
        return [$value];
    }
}
```



## Available Filters

- [`Centum\Filter\Blacklist`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Blacklist.php)
- [`Centum\Filter\Callback`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Callback.php)
- [`Centum\Filter\Group`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Group.php)
- [`Centum\Filter\Whitelist`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Whitelist.php)
- `Centum\Filter\Cast`
  - [`Centum\Filter\Cast\ToArray`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Cast/ToArray.php)
  - [`Centum\Filter\Cast\ToBool`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Cast/ToBool.php)
  - [`Centum\Filter\Cast\ToNull`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Cast/ToNull.php)
  - [`Centum\Filter\Cast\ToString`](https://github.com/SidRoberts/centum/tree/development/src/Filter/Cast/ToString.php)
- `Centum\Filter\String`
  - [`Centum\Filter\String\Alpha`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Alpha.php)
  - [`Centum\Filter\String\Alphanumeric`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Alphanumeric.php)
  - [`Centum\Filter\String\Base64Decode`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Base64Decode.php)
  - [`Centum\Filter\String\Base64Encode`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Base64Encode.php)
  - [`Centum\Filter\String\Prefix`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Prefix.php)
  - [`Centum\Filter\String\Replace`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Replace.php)
  - [`Centum\Filter\String\Suffix`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Suffix.php)
  - [`Centum\Filter\String\ToLower`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/ToLower.php)
  - [`Centum\Filter\String\ToUpper`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/ToUpper.php)
  - [`Centum\Filter\String\Trim`](https://github.com/SidRoberts/centum/tree/development/src/Filter/String/Trim.php)
