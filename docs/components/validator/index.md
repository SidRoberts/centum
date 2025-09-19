---
layout: default
title: Validator Component
has_children: true
permalink: validator
---



# `Centum\Validator`

Validators are used to validate data and provide useful error messages explaining why a piece of data failed.

{: .callout.info }
Validators must implement [`Centum\Interfaces\Validator\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Validator/ValidatorInterface.php).

Validators require one public method:

- `validate(mixed $value): list<non-empty-string>`

The `validate()` method must return an array of string messages explaining why the data is not valid.
If a piece of data is valid, then `validate()` would return an empty array.



## Links

- [Source code (`src/Validator/`)](https://github.com/SidRoberts/centum/blob/main/src/Validator/)
- [Interfaces (`src/Interfaces/Validator/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Validator/)
- [Unit tests (`tests/Unit/Validator/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Validator/)
