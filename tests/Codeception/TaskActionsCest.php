<?php

namespace Tests\Codeception;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;
use Tests\Support\CodeceptionTester;

class TaskActionsCest
{
    public function testExecuteTask(CodeceptionTester $I): void
    {
        $task = new class implements TaskInterface {
            public bool $wasExecuted = false;

            public function execute(ContainerInterface $container): void
            {
                $this->wasExecuted = true;                
            }
        };

        $I->executeTask($task);

        $I->assertTrue(
            $task->wasExecuted
        );
    }
}
