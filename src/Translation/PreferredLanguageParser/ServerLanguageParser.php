<?php

namespace Centum\Translation\PreferredLanguageParser;

use RuntimeException;

/**
 * Parses the `$_SERVER["LANG"]` variable to determine the preferred language.
 * If a language-region pair is specified, it will return the language as well.
 */
class ServerLanguageParser
{
    /**
     * @param non-empty-string $serverLang
     *
     * @return list<non-empty-string>
     *
     * @throws RuntimeException
     */
    public function parse(string $serverLang): array
    {
        // Example: "en-GB.UTF-8" -> "en-GB"
        $lang = preg_replace("/\..*$/", "", $serverLang);

        if ($lang === null) {
            throw new RuntimeException("preg_replace failed.");
        }

        // Normalise separator: en-GB -> en_GB
        $lang = str_replace("-", "_", $lang);

        $parts = explode("_", $lang);

        /** @var non-empty-string */
        $language = mb_strtolower($parts[0]);

        if (count($parts) === 1) {
            return [
                $language,
            ];
        }

        /** @var non-empty-string */
        $region = mb_strtoupper($parts[1]);

        return [
            $language . "_" . $region,
            $language,
        ];
    }
}
