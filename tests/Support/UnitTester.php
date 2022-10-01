<?php

namespace Tests\Support;

use Centum\Codeception\Actions\TaskActions;
use Centum\Codeception\Actions\UnitTestActions;
use Centum\Codeception\Actions\ValidatorActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;

    use TaskActions;
    use UnitTestActions;
    use ValidatorActions;
}
