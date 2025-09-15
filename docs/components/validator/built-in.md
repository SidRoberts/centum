---
layout: default
title: Built-In Validators
parent: Validator
grand_parent: Components
permalink: validator/built-in
nav_order: 1
---



# Built-In Validators



## [`Centum\Validator\Alpha`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Alpha.php)

Checks if a value is an alphabetic string (no numbers, spaces, or
punctuation).



## [`Centum\Validator\Alphanumeric`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Alphanumeric.php)

Checks if a value is an alphanumeric string.



## [`Centum\Validator\Base64`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Base64.php)

Checks if a value is a valid base64 string.



## [`Centum\Validator\Callback`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Callback.php)

Checks a value against a callback function. Allows custom Validators to be
wrapped within a callable.



## [`Centum\Validator\CommandSlug`](https://github.com/SidRoberts/centum/blob/main/src/Validator/CommandSlug.php)

Checks if a value is a Command slug (i.e. all lowercase, alphanumeric with
dashes and colons, starting and ending with a letter or number).

This differs from `Centum\Validator\Slug` in that colons are also allowed.



## [`Centum\Validator\EmailAddress`](https://github.com/SidRoberts/centum/blob/main/src/Validator/EmailAddress.php)

Checks if a value is a valid email address.



## [`Centum\Validator\InArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/InArray.php)

Checks if a value is in an array of values.



## [`Centum\Validator\LanguageCode`](https://github.com/SidRoberts/centum/blob/main/src/Validator/LanguageCode.php)

Checks if a value is a valid ISO language code.



## [`Centum\Validator\NotEmpty`](https://github.com/SidRoberts/centum/blob/main/src/Validator/NotEmpty.php)

Checks if a value is not empty.



## [`Centum\Validator\NotInArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/NotInArray.php)

Checks if a value is not in an array of values.



## [`Centum\Validator\RegularExpression`](https://github.com/SidRoberts/centum/blob/main/src/Validator/RegularExpression.php)

Checks if a value matches a regular expression.



## [`Centum\Validator\Slug`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Slug.php)

Checks if a value is a slug (i.e. all lowercase, alphanumeric with dashes,
starting and ending with a letter or number).



## [`Centum\Validator\TimeZone`](https://github.com/SidRoberts/centum/blob/main/src/Validator/TimeZone.php)

Checks if a value is a valid time zone identifier.



## [`Centum\Validator\Type\IsA`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsA.php)

Checks if a value is an instance of a particular class.



## [`Centum\Validator\Type\IsArray`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsArray.php)

Checks if a value is an array.



## [`Centum\Validator\Type\IsBoolean`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsBoolean.php)

Checks if a value is a boolean.



## [`Centum\Validator\Type\IsCallable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCallable.php)

Checks if a value is a callable.



## [`Centum\Validator\Type\IsCharacter`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCharacter.php)

Checks if a value is a single character.



## [`Centum\Validator\Type\IsCountable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsCountable.php)

Checks if a value is countable.



## [`Centum\Validator\Type\IsInstanceOf`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsInstanceOf.php)

Checks if a value is an instance of a particular object.



## [`Centum\Validator\Type\IsInteger`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsInteger.php)

Checks if a value is an integer or an integer string.



## [`Centum\Validator\Type\IsIterable`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsIterable.php)

Checks if a value is iterable.



## [`Centum\Validator\Type\IsNull`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsNull.php)

Checks if a value is `null`.



## [`Centum\Validator\Type\IsObject`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsObject.php)

Checks if a value is an object.



## [`Centum\Validator\Type\IsResource`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsResource.php)

Checks if a value is a resource.



## [`Centum\Validator\Type\IsScalar`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsScalar.php)

Checks if a value is a scalar.



## [`Centum\Validator\Type\IsString`](https://github.com/SidRoberts/centum/blob/main/src/Validator/Type/IsString.php)

Checks if a value is a string.



## [`Centum\Validator\ZipCode`](https://github.com/SidRoberts/centum/blob/main/src/Validator/ZipCode.php)

Checks if a value is a valid US zip code (either in the form of 12345 or
12345-6789).
