<?php

namespace Centum\Http\Csrf;

use Centum\Http\Exception\CsrfException;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\DataInterface;
use Centum\Interfaces\Http\RequestInterface;

class Validator implements ValidatorInterface
{
    protected readonly DataInterface $data;



    public function __construct(
        RequestInterface $request,
        protected readonly StorageInterface $storage
    ) {
        $this->data = $request->getData();
    }



    public function validate(): void
    {
        /** @var string|null */
        $value = $this->data->get("csrf");

        if ($value === null || $this->storage->get() !== $value) {
            throw new CsrfException($value);
        }
    }
}
