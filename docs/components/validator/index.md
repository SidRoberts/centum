---
layout: default
title: Validator
parent: Components
has_children: true
permalink: validator
---



# `Centum\Validator`

Validators are used to validate data and provide useful error messages explaining why a piece of data failed.

{: .note }
Validators must implement [`Centum\Interfaces\Validator\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Validator/ValidatorInterface.php).

Validators only require one public method:

- `validate(mixed $value): list<non-empty-string>`

The `validate()` method must return an array of string messages explaining why the data is not valid.
If a piece of data is valid, then `validate()` would return an empty array.
