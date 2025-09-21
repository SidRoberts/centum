---
layout: default
title: Built-In Validators
parent: Validator Component
permalink: validator/built-in
nav_order: 1
---



# Built-In Validators

These validators are all in the `Centum\Validator` namespace.



## [`Alpha`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Alpha.php)

Checks if a value is an alphabetic string (no numbers, spaces, or
punctuation).



## [`Alphanumeric`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Alphanumeric.php)

Checks if a value is an alphanumeric string.



## [`Base64`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Base64.php)

Checks if a value is a valid base64 string.



## [`Callback`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Callback.php)

Checks a value against a callback function. Allows custom Validators to be
wrapped within a callable.



## [`CommandSlug`](https://github.com/SidRoberts/centum/blob/main/src/Validator/CommandSlug.php)

Checks if a value is a Command slug (i.e. all lowercase, alphanumeric with
dashes and colons, starting and ending with a letter or number).

This differs from `Slug` in that colons are also allowed.



## [`EmailAddress`](https://github.com/SidRoberts/centum/blob/main/src/Validator/EmailAddress.php)

Checks if a value is a valid email address.



## [`InArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/InArray.php)

Checks if a value is in an array of values.



## [`LanguageCode`](https://github.com/SidRoberts/centum/blob/main/src/Validator/LanguageCode.php)

Checks if a value is a valid ISO language code.



## [`NotEmpty`](https://github.com/SidRoberts/centum/blob/main/src/Validator/NotEmpty.php)

Checks if a value is not empty.



## [`NotInArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/NotInArray.php)

Checks if a value is not in an array of values.



## [`RegularExpression`](https://github.com/SidRoberts/centum/blob/main/src/Validator/RegularExpression.php)

Checks if a value matches a regular expression.



## [`Slug`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Slug.php)

Checks if a value is a slug (i.e. all lowercase, alphanumeric with dashes,
starting and ending with a letter or number).



## [`TimeZone`](https://github.com/SidRoberts/centum/blob/main/src/Validator/TimeZone.php)

Checks if a value is a valid time zone identifier.



## [`Type\IsA`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsA.php)

Checks if a value is an instance of a particular class.



## [`Type\IsArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsArray.php)

Checks if a value is an array.



## [`Type\IsBoolean`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsBoolean.php)

Checks if a value is a boolean.



## [`Type\IsCallable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCallable.php)

Checks if a value is a callable.



## [`Type\IsCharacter`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCharacter.php)

Checks if a value is a single character.



## [`Type\IsCountable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCountable.php)

Checks if a value is countable.



## [`Type\IsInstanceOf`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsInstanceOf.php)

Checks if a value is an instance of a particular object.



## [`Type\IsInteger`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsInteger.php)

Checks if a value is an integer or an integer string.



## [`Type\IsIterable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsIterable.php)

Checks if a value is iterable.



## [`Type\IsNull`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsNull.php)

Checks if a value is `null`.



## [`Type\IsObject`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsObject.php)

Checks if a value is an object.



## [`Type\IsResource`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsResource.php)

Checks if a value is a resource.



## [`Type\IsScalar`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsScalar.php)

Checks if a value is a scalar.



## [`Type\IsString`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsString.php)

Checks if a value is a string.



## [`ZipCode`](https://github.com/SidRoberts/centum/blob/main/src/Validator/ZipCode.php)

Checks if a value is a valid US zip code (either in the form of 12345 or
12345-6789).
