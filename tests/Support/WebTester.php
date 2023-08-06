<?php

namespace Tests\Support;

use Centum\Codeception\Actions\AjaxActions;
use Centum\Codeception\Actions\HtmlActions;
use Centum\Codeception\Actions\RouterActions;
use Centum\Codeception\Actions\SessionActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class WebTester extends Actor
{
    use _generated\WebTesterActions;

    use AjaxActions;
    use HtmlActions;
    use RouterActions;
    use SessionActions;
}
