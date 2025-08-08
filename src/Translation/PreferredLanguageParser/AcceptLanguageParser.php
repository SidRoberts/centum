<?php

namespace Centum\Translation\PreferredLanguageParser;

/**
 * Parses the HTTP "Accept-Language" HTTP request header into an ordered list of
 * preferred languages.
 */
final class AcceptLanguageParser
{
    /**
     * @return list<non-empty-string>
     */
    public function parse(string $acceptLanguage): array
    {
        $languages       = explode(",", $acceptLanguage);
        $parsedLanguages = [];

        foreach ($languages as $language) {
            $parts = explode(";", $language);

            /** @var non-empty-string */
            $lang = mb_trim($parts[0]);

            // Normalise separator: en-US -> en_US
            /** @var non-empty-string */
            $lang = str_replace("-", "_", $lang);

            $qValue = isset($parts[1]) ? (float) mb_trim(str_replace("q=", "", $parts[1])) : 1.0;

            if ($qValue > 0) {
                $parsedLanguages[$lang] = $qValue;
            }
        }

        arsort($parsedLanguages);

        return array_keys($parsedLanguages);
    }
}
