<?php

namespace Tests\Support;

use Centum\Interfaces\Queue\TaskInterface;
use Codeception\Actor;
use Throwable;

/**
 * @SuppressWarnings(PHPMD)
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;



    public function getEchoContent(callable $callable): string
    {
        ob_start();

        try {
            call_user_func($callable);
        } catch (Throwable $throwable) {
            ob_end_clean();

            throw $throwable;
        }

        return ob_get_clean();
    }

    public function expectEcho(string $expected, callable $callable): void
    {
        $actual = $this->getEchoContent($callable);

        $this->assertEquals(
            $expected,
            $actual,
            "Failed asserting callable echoes an expected string."
        );
    }



    public function executeTask(TaskInterface $task): void
    {
        $container = $this->getContainer();

        $task->execute($container);
    }
}
