<?php

namespace Centum\Translation\Exception;

use Centum\Interfaces\Translation\LocaleInterface;
use RuntimeException;

final class MissingTranslationException extends RuntimeException
{
    public function __construct(
        protected readonly LocaleInterface $locale,
        protected readonly string $domain,
        protected readonly string $key
    ) {
        $message = sprintf(
            "Translation for domain '%s' and key '%s' not found in %s locale.",
            $domain,
            $key,
            $locale->getCode()
        );

        parent::__construct($message);
    }



    public function getLocale(): LocaleInterface
    {
        return $this->locale;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
