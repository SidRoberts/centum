<?php

namespace Centum\Http\Exception;

use Centum\Http\File;

class FileAlreadyMovedException extends \Exception
{
    public function __construct(
        protected readonly File $centumFile
    ) {
    }



    public function getCentumFile(): File
    {
        return $this->centumFile;
    }
}
