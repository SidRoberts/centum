---
layout: default
title: Exceptions
parent: Http Component
permalink: http/exceptions
nav_order: 101
---



# Exceptions

(all in the `Centum\Http\Exception` namespace)



## [`CannotReadFileException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/CannotReadFileException.php)

Thrown in:

- [`Centum\Http\Response\FileResponse::__construct()`](https://github.com/SidRoberts/centum/blob/main/src/Http/Response/FileResponse.php#L18)



## [`CookieKeyEmptyException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/CookieKeyEmptyException.php)

Thrown in:

- [`Centum\Http\CookiesFactory::createFromBrowserKitRequest()`](https://github.com/SidRoberts/centum/blob/main/src/Http/CookiesFactory.php#L35)



## [`CsrfException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/CsrfException.php)

Thrown in:

- [`Centum\Http\Csrf\Validator::validate()`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Validator.php#L23)



## [`FailedToOpenInputStreamException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/FailedToOpenInputStreamException.php)

Thrown in:

- [`Centum\Http\RequestFactory::createFromGlobals()`](https://github.com/SidRoberts/centum/blob/main/src/Http/RequestFactory.php#L17)



## [`FileAlreadyMovedException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/FileAlreadyMovedException.php)

Thrown in:

- [`Centum\Http\File::moveTo()`](https://github.com/SidRoberts/centum/blob/main/src/Http/File.php#L112)



## [`FileGroupAlreadyExistsException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/FileGroupAlreadyExistsException.php)

Thrown in:

- [`Centum\Http\Files::add()`](https://github.com/SidRoberts/centum/blob/main/src/Http/Files.php#L34)



## [`FileGroupNotFoundException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/FileGroupNotFoundException.php)

Thrown in:

- [`Centum\Http\Files::get()`](https://github.com/SidRoberts/centum/blob/main/src/Http/Files.php#L55)



## [`HeaderKeyEmptyException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/HeaderKeyEmptyException.php)

Thrown in:

- [`Centum\Http\HeadersFactory::createFromBrowserKitRequest()`](https://github.com/SidRoberts/centum/blob/main/src/Http/HeadersFactory.php#L36)



## [`UriParseException`](https://github.com/SidRoberts/centum/blob/main/src/Http/Exception/UriParseException.php)

Thrown in:

- [`Centum\Http\RequestFactory::createFromGlobals()`](https://github.com/SidRoberts/centum/blob/main/src/Http/RequestFactory.php#L17)
- [`Centum\Http\RequestFactory::createFromArrays()`](https://github.com/SidRoberts/centum/blob/main/src/Http/RequestFactory.php#L37)
