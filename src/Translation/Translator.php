<?php

namespace Centum\Translation;

use Centum\Interfaces\Translation\LocaleInterface;
use Centum\Interfaces\Translation\TranslatorInterface;
use Centum\Translation\Exception\MissingTranslationException;
use MessageFormatter;

final class Translator implements TranslatorInterface
{
    public function __construct(
        protected readonly LocaleInterface $locale
    ) {
    }



    /**
     * @throws MissingTranslationException
     */
    public function translate(string $domain, string $key, array $values = []): string
    {
        $translations = $this->locale->getTranslations();

        if (!isset($translations[$domain][$key])) {
            throw new MissingTranslationException(
                $this->locale,
                $domain,
                $key
            );
        }

        $localeCode = $this->locale->getCode();

        $text = $translations[$domain][$key];

        return MessageFormatter::formatMessage($localeCode, $text, $values);
    }
}
