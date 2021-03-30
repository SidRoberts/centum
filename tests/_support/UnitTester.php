<?php

namespace Tests;

use Codeception\Actor;
use Throwable;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
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
