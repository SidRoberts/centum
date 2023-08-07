<?php

namespace Centum\Filter\String;

use Centum\Interfaces\Filter\FilterInterface;
use Exception;
use InvalidArgumentException;

class FileName implements FilterInterface
{
    public function filter(mixed $value, string $replacement = "_"): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value must be a string.");
        }

        $problematicCharacters = [
            '<',
            '>',
            ':',
            '"',
            '/',
            '\\',
            '|',
            '?',
            '*',
        ];

        for ($i = 0; $i < 32; $i++) {
            $problematicCharacters[] = chr($i);
        }

        $fileName = str_replace($problematicCharacters, $replacement, $value);

        $fileName = trim($fileName);

        if (!$fileName) {
            throw new Exception("Not a valid filename.");
        }

        return $fileName;
    }
}
