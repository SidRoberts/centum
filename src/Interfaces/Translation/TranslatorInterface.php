<?php

namespace Centum\Interfaces\Translation;

interface TranslatorInterface
{
    /**
     * Translate a text to the target language.
     *
     * @param non-empty-string               $domain
     * @param non-empty-string               $key
     * @param array<non-empty-string, mixed> $values
     */
    public function translate(string $domain, string $key, array $values = []): string;
}
