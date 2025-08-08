<?php

namespace Centum\Translation\Exception;

use RuntimeException;

final class LocaleKeyNotFoundException extends RuntimeException
{
    /**
     * @param non-empty-string $localeCode
     */
    public function __construct(
        protected readonly string $localeCode
    ) {
    }



    /**
     * @return non-empty-string
     */
    public function getLocaleCode(): string
    {
        return $this->localeCode;
    }
}
