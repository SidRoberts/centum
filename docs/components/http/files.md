---
layout: default
title: Files
parent: Http
grand_parent: Components
permalink: http/files
nav_order: 5
---



# Files

HTTP Files are encapsulated in 3 classes in Centum:

- [`Centum\Http\Files`](https://github.com/SidRoberts/centum/blob/development/src/Http/Files.php)
- [`Centum\Http\FileGroup`](https://github.com/SidRoberts/centum/blob/development/src/Http/FileGroup.php)
- [`Centum\Http\File`](https://github.com/SidRoberts/centum/blob/development/src/Http/File.php)

{: .highlight }
[`Centum\Http\Files`](https://github.com/SidRoberts/centum/blob/development/src/Http/Files.php) implements [`Centum\Interfaces\Http\FilesInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FilesInterface.php).

{: .highlight }
[`Centum\Http\FileGroup`](https://github.com/SidRoberts/centum/blob/development/src/Http/FileGroup.php) implements [`Centum\Interfaces\Http\FileGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileGroupInterface.php).

{: .highlight }
[`Centum\Http\File`](https://github.com/SidRoberts/centum/blob/development/src/Http/File.php) implements [`Centum\Interfaces\Http\FileGroupInte`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileGroupInte.php).

In an effort to simplify file uploads, both from the complexity of HTML file inputs in forms and the complexity of the `$_FILES` superglobal, a FileGroup represents all files that share the `name` property.
In this HTML form, three `name` properties exist - `images`, `documents`, `audio`:

```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="images" multiple>

    <input type="file" name="documents[]">
    <input type="file" name="documents[]">

    <input type="file" name="audio">

    <input type="submit" value="Upload">
</form>
```

Regardless of how files are uploaded and how many are uploaded, they all operate the same way in PHP:

```php
use Centum\Http\FileGroup;
use Centum\Http\File;
use Centum\Http\Files;

/** @var Files $files */

/** @var FileGroup $imagesFileGroup */
$imagesFileGroup = $files->get("images");

foreach ($imagesFileGroup->all() as $image) {
    /** @var File $image */
}

/** @var FileGroup $documentsFileGroup */
$documentsFileGroup = $files->get("document");

foreach ($documentsFileGroup->all() as $document) {
    /** @var File $document */
}

/** @var FileGroup $audioFileGroup */
$audioFileGroup = $files->get("audio");

foreach ($audioFileGroup->all() as $audio) {
    /** @var File $audio */
}
```



## `Centum\Http\File`

A File object represents an individual file that has been uploaded:

```php
Centum\Http\File(
    ?string $name,
    ?string $type,
    int $size,
    ?string $location,
    int $error
);
```

- `$location` represents the file location on the server.
- `$error` shares the same codes as regular [file upload errors](https://www.php.net/manual/en/features.file-upload.errors.php).



## Files Factory

You can obtain a Files object made with global variables using the [FilesFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/FilesFactory.php):

```php
use Centum\Http\FilesFactory;

$filesFactory = new FilesFactory();

$files = $filesFactory->createFromGlobals();
```



## File Factory

You can obtain a [`File`](https://github.com/SidRoberts/centum/blob/development/src/Http/File.php) object from a real file using the [`FileFactory`](https://github.com/SidRoberts/centum/blob/development/src/Http/FileFactory.php):

```php
use Centum\Http\FileFactory;

$fileFactory = new FileFactory();

$file = $fileFactory->createFromRealFile("/path/to/a/file.txt");
```
