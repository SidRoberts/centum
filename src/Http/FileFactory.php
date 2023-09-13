<?php

namespace Centum\Http;

use Centum\Interfaces\Http\FileInterface;
use Exception;

class FileFactory
{
    /**
     * @throws Exception
     */
    public function createFromRealFile(string $path): FileInterface
    {
        $name = basename($path);
        $type = mime_content_type($path);

        /** @var non-negative-int|false */
        $size = filesize($path);

        $location = realpath($path);

        if ($type === false || $size === false || $location === false) {
            throw new Exception(
                "Unable to properly read file."
            );
        }

        return new File($name, $type, $size, $location, UPLOAD_ERR_OK);
    }
}
