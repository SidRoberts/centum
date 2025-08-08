<?php

namespace Centum\Interfaces\Translation;

interface LocaleInterface
{
    /**
     * @return non-empty-string
     */
    public function getCode(): string;

    /**
     * @return array<non-empty-string, array<non-empty-string, non-empty-string>>
     */
    public function getTranslations(): array;



    /**
     * @return list<non-empty-string>
     */
    public function flattenKeys(): array;
}
