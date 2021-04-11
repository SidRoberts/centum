<?php

namespace Tests;

use Codeception\Actor;
use Throwable;

/**
 * @SuppressWarnings(PHPMD)
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;

    public function expectEcho(string $expected, callable $callable): void
    {
        ob_start();

        try {
            $callable();
        } catch (Throwable $throwable) {
            ob_end_clean();

            throw $throwable;
        }

        $actual = ob_get_clean();

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting callable echoes an expected string."
        );
    }
}
