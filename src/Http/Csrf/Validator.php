<?php

namespace Centum\Http\Csrf;

use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\DataInterface;

class Validator implements ValidatorInterface
{
    public function __construct(
        protected readonly DataInterface $data,
        protected readonly StorageInterface $storage
    ) {
    }



    /**
     * @throws CsrfException
     */
    public function validate(): void
    {
        if (!$this->data->has("csrf")) {
            throw new CsrfException(null);
        }

        /** @var string|null */
        $value = $this->data->get("csrf");

        if ($value === null || $this->storage->get() !== $value) {
            throw new CsrfException($value);
        }
    }
}
