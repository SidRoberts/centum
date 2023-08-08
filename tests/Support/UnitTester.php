<?php

namespace Tests\Support;

use Centum\Codeception\Actions\CsrfActions;
use Centum\Codeception\Actions\FilterActions;
use Centum\Codeception\Actions\HttpFormActions;
use Centum\Codeception\Actions\QueueActions;
use Centum\Codeception\Actions\RouterReplacementActions;
use Centum\Codeception\Actions\UnitTestActions;
use Centum\Codeception\Actions\ValidatorActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;

    use CsrfActions;
    use FilterActions;
    use HttpFormActions;
    use QueueActions;
    use RouterReplacementActions;
    use UnitTestActions;
    use ValidatorActions;
}
