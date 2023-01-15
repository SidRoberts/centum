<?php

namespace Centum\Http\Response;

use Centum\Http\Header;
use Centum\Http\Headers;
use Centum\Http\Response;
use Centum\Http\Status;
use Exception;

class FileResponse extends Response
{
    public function __construct(string $filePath, string $fileName)
    {
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
            file_get_contents($filePath),
            Status::OK,
            $headers
        );
    }



    protected function sanitiseFileName(string $fileName): string
    {
        $fileName = mb_ereg_replace(
            "([^\w\s\d\-_~,\[\]\(\).'\"])",
            "",
            $fileName
        );

        if (!$fileName) {
            throw new Exception();
        }

        $fileName = trim($fileName);

        return $fileName;
    }
}
