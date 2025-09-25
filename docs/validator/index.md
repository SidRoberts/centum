---
layout: default
title: Validator Component
has_children: true
permalink: validator
---



# `Centum\Validator`

Validators are used to validate data and provide useful error messages explaining why a piece of data failed.
They provide a consistent way to enforce rules across your application, ensuring data integrity and clear feedback for developers and users.

{: .callout.info }
Validators must implement [`Centum\Interfaces\Validator\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Validator/ValidatorInterface.php).

Validators require one public method:

- `validate(mixed $value): list<non-empty-string>`

The `validate()` method must return an array of string messages explaining why the data is not valid.
If a piece of data is valid, then `validate()` would return an empty array.
This makes the interface simple to use: check if the result is empty, and if not, you have descriptive error messages ready for display or logging.

You can create [custom validators](custom-validators.md) to encapsulate specific business rules.
For example, you might validate that a string contains only alphanumeric characters, or that a number is within a certain range.
By splitting responsibilities into small validator classes, your code becomes easier to test, maintain, and reuse.



## Links

- [Source code (`src/Validator/`)](https://github.com/SidRoberts/centum/blob/main/src/Validator/)
- [Interfaces (`src/Interfaces/Validator/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Validator/)
- [Unit tests (`tests/Unit/Validator/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Validator/)
