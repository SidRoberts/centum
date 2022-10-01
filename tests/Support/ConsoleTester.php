<?php

namespace Tests\Support;

use Centum\Codeception\Actions\ConsoleActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class ConsoleTester extends Actor
{
    use _generated\ConsoleTesterActions;

    use ConsoleActions;
}
