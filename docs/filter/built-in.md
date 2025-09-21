---
layout: default
title: Built-In Filters
parent: Filter Component
permalink: filter/built-in
nav_order: 1
---



# Built-In Filters



## [`Centum\Filter\Blacklist`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Blacklist.php)

Filters out any values in a blacklist.



## [`Centum\Filter\Callback`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Callback.php)

Filters a value based on a callback.



## [`Centum\Filter\Cast\ToArray`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Cast/ToArray.php)

Casts any value to an array.



## [`Centum\Filter\Cast\ToBool`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Cast/ToBool.php)

Casts any value to a boolean.



## [`Centum\Filter\Cast\ToInteger`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Cast/ToInteger.php)

Casts resources, scalars, and null values to integers.



## [`Centum\Filter\Cast\ToNull`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Cast/ToNull.php)

Filters any value to `null`.



## [`Centum\Filter\Cast\ToString`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Cast/ToString.php)

Casts values to a string. Objects are cast using `__toString()` or are serialised; arrays are JSON encoded.



## [`Centum\Filter\Group`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Group.php)

Groups multiple Filters together so that they can be used as one.



## [`Centum\Filter\String\Alpha`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Alpha.php)

Filters a string to only alphabetical characters.



## [`Centum\Filter\String\Alphanumeric`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Alphanumeric.php)

Filters a string to only alphanumeric characters.



## [`Centum\Filter\String\Base64Decode`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Base64Decode.php)

Base64 decodes a string.



## [`Centum\Filter\String\Base64Encode`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Base64Encode.php)

Base64 encodes a string.



## [`Centum\Filter\String\CamelCaseToSlug`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/CamelCaseToSlug.php)

Converts camel case to a slug (lowercase, alphanumeric with dashes).



## [`Centum\Filter\String\FileName`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/FileName.php)

Filters a value to only allow valid characters for a file name.



## [`Centum\Filter\String\Prefix`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Prefix.php)

Adds a prefix to a string.



## [`Centum\Filter\String\Replace`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Replace.php)

Replace all occurrences of the search string with the replacement string.



## [`Centum\Filter\String\Rot13`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Rot13.php)

Performs the `rot13` transformation on a string.



## [`Centum\Filter\String\SlugToCamelCase`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/SlugToCamelCase.php)

Converts a slug (lowercase, alphanumeric with dashes) to camel case.



## [`Centum\Filter\String\Suffix`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Suffix.php)

Adds a suffix to a string.



## [`Centum\Filter\String\ToLower`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/ToLower.php)

Filters a string to lowercase.



## [`Centum\Filter\String\ToUpper`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/ToUpper.php)

Filters a string to uppercase.



## [`Centum\Filter\String\Trim`](https://github.com/SidRoberts/centum/blob/main/src/Filter/String/Trim.php)

Trims a string.



## [`Centum\Filter\Whitelist`](https://github.com/SidRoberts/centum/blob/main/src/Filter/Whitelist.php)

Filters only values in a whitelist.
