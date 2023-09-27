<?php

namespace Centum\Http\Csrf;

use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Exception;

class Generator implements GeneratorInterface
{
    /**
     * @throws Exception
     */
    public function generate(): string
    {
        $binaryLength = (int) ceil(self::LENGTH / 2);

        if ($binaryLength < 1) {
            throw new Exception();
        }

        $binaryString = random_bytes($binaryLength);

        $hexString = bin2hex($binaryString);

        $randomString = mb_substr($hexString, 0, self::LENGTH);

        return $randomString;
    }
}
