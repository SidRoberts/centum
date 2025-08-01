<?php

namespace Centum\Http\Response;

use Centum\Http\Exception\CannotReadFileException;
use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Exception;

class FileResponse extends Response
{
    /**
     * @throws Exception
     * @throws CannotReadFileException
     */
    public function __construct(string $filePath, string $fileName)
    {
        $content = @file_get_contents($filePath);

        if ($content === false) {
            throw new CannotReadFileException($filePath);
        }



        $fileName = $this->sanitiseFileName($fileName);

        $fileSize = filesize($filePath);

        $headers = new Headers(
            [
                new Header("Content-Description", "File Transfer"),
                new Header("Content-Type", "application/octet-stream"),
                new Header("Content-Disposition", "attachment; filename=\"" . addcslashes($fileName, "\"") . "\""),
                new Header("Content-Transfer-Encoding", "binary"),
                new Header("Connection", "Keep-Alive"),
                new Header("Expires", "0"),
                new Header("Cache-Control", "must-revalidate, post-check=0, pre-check=0"),
                new Header("Pragma", "public"),
                new Header("Content-Length", (string) $fileSize),
            ]
        );



        parent::__construct(
            $content,
            Status::OK,
            $headers
        );
    }



    /**
     * @throws Exception
     */
    protected function sanitiseFileName(string $fileName): string
    {
        $fileName = preg_replace(
            "/([^\w\s\d\-_~,\[\]\(\).'\"]+)/",
            "",
            $fileName
        );

        if ($fileName === null || $fileName === "") {
            throw new Exception();
        }

        $fileName = mb_trim($fileName);

        return $fileName;
    }
}
