<?php

namespace Centum\Translation\Exception;

use RuntimeException;

final class LocaleFileNotFoundException extends RuntimeException
{
    public function __construct(
        protected readonly string $localePath
    ) {
    }



    public function getLocalePath(): string
    {
        return $this->localePath;
    }
}
