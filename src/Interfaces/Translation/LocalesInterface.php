<?php

namespace Centum\Interfaces\Translation;

interface LocalesInterface
{
    /**
     * @return list<non-empty-string>
     */
    public function getAvailableCodes(): array;

    /**
     * @param non-empty-string $code
     */
    public function load(string $code): LocaleInterface;
}
