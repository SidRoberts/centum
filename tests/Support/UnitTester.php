<?php

namespace Tests\Support;

use Centum\Codeception\Actions\FilterActions;
use Centum\Codeception\Actions\QueueActions;
use Centum\Codeception\Actions\UnitTestActions;
use Centum\Codeception\Actions\ValidatorActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;

    use FilterActions;
    use QueueActions;
    use UnitTestActions;
    use ValidatorActions;
}
