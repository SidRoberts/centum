<?php

namespace Centum\Translation;

use Centum\Interfaces\Translation\LocaleInterface;

final class Locale implements LocaleInterface
{
    /**
     * @param non-empty-string                                                   $code
     * @param array<non-empty-string, array<non-empty-string, non-empty-string>> $translations
     */
    public function __construct(
        protected readonly string $code,
        protected readonly array $translations
    ) {
    }



    public function getCode(): string
    {
        return $this->code;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }



    public function flattenKeys(): array
    {
        $flattenedKeys = [];

        foreach ($this->translations as $domain => $translations) {
            foreach (array_keys($translations) as $key) {
                $flattenedKeys[] = "{$domain}.{$key}";
            }
        }

        return $flattenedKeys;
    }
}
