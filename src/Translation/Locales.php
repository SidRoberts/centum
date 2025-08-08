<?php

namespace Centum\Translation;

use Centum\Interfaces\Translation\LocaleInterface;
use Centum\Interfaces\Translation\LocalesInterface;
use Centum\Translation\Exception\LocaleFileNotFoundException;
use Centum\Translation\Exception\LocaleKeyNotFoundException;

final class Locales implements LocalesInterface
{
    /**
     * @param array<non-empty-string, non-empty-string> $locales
     */
    public function __construct(
        protected readonly array $locales = []
    ) {
    }



    public function getAvailableCodes(): array
    {
        return array_keys($this->locales);
    }

    /**
     * @throws LocaleKeyNotFoundException
     * @throws LocaleFileNotFoundException
     */
    public function load(string $code): LocaleInterface
    {
        if (!array_key_exists($code, $this->locales)) {
            throw new LocaleKeyNotFoundException($code);
        }

        $path = $this->locales[$code];

        if (!file_exists($path)) {
            throw new LocaleFileNotFoundException($path);
        }

        /**
         * @var array<non-empty-string, array<non-empty-string, non-empty-string>>
         */
        $translations = require $path;

        return new Locale($code, $translations);
    }
}
