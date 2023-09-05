<?php

namespace Centum\Http;

use Centum\Interfaces\Http\FilesInterface;
use Exception;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;

class FilesFactory
{
    public function createFromGlobal(): FilesInterface
    {
        /** @var array<non-empty-string, array> $_FILES */

        return $this->createFromArray($_FILES);
    }

    /**
     * @param array<non-empty-string, array> $array
     */
    public function createFromArray(array $array): FilesInterface
    {
        $files = new Files();

        foreach ($array as $id => $abc) {
            if (!is_array($abc["name"])) {
                $abc = [
                    "name"      => [$abc["name"]],
                    "type"      => [$abc["type"]],
                    "size"      => [$abc["size"]],
                    "tmp_name"  => [$abc["tmp_name"]],
                    "error"     => [$abc["error"]],
                    "full_path" => [$abc["full_path"]],
                ];
            }

            /**
             * @var array{
             *     name: array<string>,
             *     type: array<string>,
             *     size: array<non-negative-int>,
             *     tmp_name: array<string>,
             *     error: array<int>,
             *     full_path: array<string>
             * } $abc
             */
            $numberOfFiles = count($abc["name"]);

            $fileGroup = new FileGroup($id);

            for ($i = 0; $i < $numberOfFiles; $i++) {
                $file = new File(
                    $abc["name"][$i],
                    $abc["type"][$i],
                    $abc["size"][$i],
                    $abc["tmp_name"][$i],
                    $abc["error"][$i]
                );

                $fileGroup->add($file);
            }

            $files->add($fileGroup);
        }

        return $files;
    }

    public function createFromBrowserKitRequest(BrowserKitRequest $browserKitRequest): FilesInterface
    {
        $browserKitFiles = $browserKitRequest->getFiles();

        if (count($browserKitFiles) > 0) {
            throw new Exception(
                "Not implemented due to being unable to get the file location of a PSR7 UploadedFile."
            );
        }

        return new Files();
    }
}
