<?php

namespace Tests\Support;

use Centum\Codeception\Actions\AccessActions;
use Centum\Codeception\Actions\AjaxActions;
use Centum\Codeception\Actions\ConsoleActions;
use Centum\Codeception\Actions\ContainerActions;
use Centum\Codeception\Actions\CookieActions;
use Centum\Codeception\Actions\CsrfActions;
use Centum\Codeception\Actions\FilterActions;
use Centum\Codeception\Actions\FlashActions;
use Centum\Codeception\Actions\HeaderActions;
use Centum\Codeception\Actions\HtmlActions;
use Centum\Codeception\Actions\HttpFormActions;
use Centum\Codeception\Actions\JsonActions;
use Centum\Codeception\Actions\QueueActions;
use Centum\Codeception\Actions\RouterActions;
use Centum\Codeception\Actions\RouterReplacementActions;
use Centum\Codeception\Actions\SessionActions;
use Centum\Codeception\Actions\UnitTestActions;
use Centum\Codeception\Actions\ValidatorActions;
use Codeception\Actor;

/**
 * @SuppressWarnings(PHPMD)
 */
class CodeceptionTester extends Actor
{
    use _generated\CodeceptionTesterActions;

    use AccessActions;
    use AjaxActions;
    use ConsoleActions;
    use ContainerActions;
    use CookieActions;
    use CsrfActions;
    use FilterActions;
    use FlashActions;
    use HeaderActions;
    use HtmlActions;
    use HttpFormActions;
    use JsonActions;
    use QueueActions;
    use RouterReplacementActions;
    use RouterActions;
    use SessionActions;
    use UnitTestActions;
    use ValidatorActions;
}
