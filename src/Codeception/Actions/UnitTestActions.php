<?php

namespace Centum\Codeception\Actions;

use PHPUnit\Framework\Assert;
use ReflectionClass;
use RuntimeException;
use Throwable;

/**
 * Unit Test Actions
 */
trait UnitTestActions
{
    public function grabEchoContent(callable $callable): string
    {
        ob_start();

        try {
            call_user_func($callable);
        } catch (Throwable $throwable) {
            ob_end_clean();

            throw $throwable;
        }

        $contents = ob_get_clean();

        if ($contents === false) {
            throw new RuntimeException("Failed to get output buffer contents.");
        }

        return $contents;
    }

    public function expectEcho(string $expected, callable $callable): void
    {
        $actual = $this->grabEchoContent($callable);

        Assert::assertEquals(
            $expected,
            $actual,
            "Failed asserting callable echoes an expected string."
        );
    }



    /**
     * @param non-empty-string $name
     */
    public function getPropertyValue(object $object, string $name): mixed
    {
        $reflection = new ReflectionClass($object);

        $property = $reflection->getProperty($name);

        return $property->getValue($object);
    }



    /**
     * @param callable(): void $callback
     * @param positive-int     $times
     *
     * @return void
     */
    public function retry(callable $callback, int $times = 2): void
    {
        for ($i = 1; $i <= $times; $i++) {
            try {
                call_user_func($callback);

                break;
            } catch (Throwable $throwable) {
                if ($i === $times) {
                    throw $throwable;
                }
            }
        }
    }
}
