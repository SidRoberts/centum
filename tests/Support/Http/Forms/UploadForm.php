<?php

namespace Tests\Support\Http\Forms;

use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FormInterface;
use InvalidArgumentException;

final class UploadForm implements FormInterface
{
    public function __construct(
        protected readonly FileGroupInterface $images
    ) {
        if (count($images->all()) === 0) {
            throw new InvalidArgumentException(
                "No images uploaded."
            );
        }
    }



    public function getImages(): FileGroupInterface
    {
        return $this->images;
    }
}
