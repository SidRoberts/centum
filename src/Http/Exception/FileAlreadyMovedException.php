<?php

namespace Centum\Http\Exception;

use Centum\Http\File;

class FileAlreadyMovedException extends \Exception
{
    protected File $centumFile;



    public function __construct(File $centumFile)
    {
        $this->centumFile = $centumFile;
    }



    public function getCentumFile(): File
    {
        return $this->centumFile;
    }
}
