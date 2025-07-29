<?php

namespace Centum\Http;

use Centum\Http\Exception\FileAlreadyMovedException;
use Centum\Interfaces\Http\FileInterface;
use Exception;

class File implements FileInterface
{
    protected bool $isMoved = false;



    /**
     * @param non-negative-int $size
     */
    public function __construct(
        protected readonly ?string $name,
        protected readonly ?string $type,
        protected readonly int $size,
        protected ?string $location,
        protected readonly int $error
    ) {
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getError(): int
    {
        return $this->error;
    }



    public function isMoved(): bool
    {
        return $this->isMoved;
    }



    /**
     * @throws Exception
     */
    public function validate(): void
    {
        $error = $this->getError();

        if ($error !== UPLOAD_ERR_OK) {
            $errorMessage = match ($error) {
                UPLOAD_ERR_NO_FILE    => "No file sent.",
                UPLOAD_ERR_INI_SIZE   => "Exceeded filesize limit (\`upload_max_filesize\` directive in php.ini).",
                UPLOAD_ERR_FORM_SIZE  => "Exceeded filesize limit (\`MAX_FILE_SIZE\` directive that was specified in the HTML form).",
                UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
                UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
                UPLOAD_ERR_CANT_WRITE => "Cannot write to target directory. Please fix CHMOD.",
                UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload.",
                default               => "Unknown file upload error.",
            };

            throw new Exception(
                $errorMessage
            );
        }

        $location = $this->getLocation();

        if ($location === null || $location === "") {
            throw new Exception("No known location.");
        }
    }



    /**
     * @throws Exception
     */
    public function getExtension(): ?string
    {
        if ($this->error !== UPLOAD_ERR_OK || $this->name === null) {
            throw new Exception("File has an error.");
        }

        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    /**
     * @throws Exception
     * @throws FileAlreadyMovedException
     */
    public function moveTo(string $path): bool
    {
        if ($this->error !== UPLOAD_ERR_OK || $this->location === null) {
            throw new Exception("File has an error.");
        }

        if ($this->isMoved) {
            throw new FileAlreadyMovedException($this);
        }

        $this->isMoved = true;

        return move_uploaded_file($this->location, $path);
    }



    public function toArray(): array
    {
        return [
            "name"     => $this->name,
            "type"     => $this->type,
            "size"     => $this->size,
            "location" => $this->location,
            "error"    => $this->error,
        ];
    }
}
