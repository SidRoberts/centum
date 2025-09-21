<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use InvalidArgumentException;
use RuntimeException;

/**
 * Filters a value to only allow valid characters for a file name.
 */
class FileName implements FilterInterface
{
    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function filter(mixed $value, string $replacement = "_"): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        $problematicCharacters = [
            "<",
            ">",
            ":",
            "\"",
            "/",
            "\\",
            "|",
            "?",
            "*",
        ];

        for ($i = 0; $i < 32; $i++) {
            $problematicCharacters[] = chr($i);
        }

        $fileName = str_replace($problematicCharacters, $replacement, $value);

        $fileName = mb_trim($fileName);

        if (!$fileName) {
            throw new RuntimeException("Not a valid filename.");
        }

        return $fileName;
    }
}
