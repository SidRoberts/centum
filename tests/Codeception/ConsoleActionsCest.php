<?php

namespace Tests\Codeception;

use Centum\Interfaces\Console\ExceptionHandlerInterface;
use Tests\Support\CodeceptionTester;
use Tests\Support\Commands\ExitCodeCommand;
use Tests\Support\Commands\ThrowableExceptionHandler;

/**
 * @covers \Centum\Codeception\Actions\ConsoleActions
 */
class ConsoleActionsCest
{
    public function testCreateTerminal(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testAddRouterExceptionHandler(CodeceptionTester $I): void
    {
        $I->addConsoleExceptionHandler(ThrowableExceptionHandler::class);

        $application = $I->grabConsoleApplication();

        /**
         * @var array<class-string<ExceptionHandlerInterface>>
         */
        $exceptionHandlers = $I->getPropertyValue($application, "exceptionHandlers");

        $I->assertEquals(
            [
                ThrowableExceptionHandler::class,
            ],
            $exceptionHandlers
        );
    }



    public function testGrabStdoutContent(CodeceptionTester $I): void
    {
        $I->assertEquals(
            "",
            $I->grabStdoutContent()
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->assertEquals(
            "This is to STDOUT.123",
            $I->grabStdoutContent()
        );
    }

    public function testGrabStderrContent(CodeceptionTester $I): void
    {
        $I->assertEquals(
            "",
            $I->grabStderrContent()
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->assertEquals(
            "This is to STDERR.456",
            $I->grabStderrContent()
        );
    }

    public function testGrabConsoleApplication(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testAddCommand(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testRunCommand(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }

    public function testRunCommandReturnsExitCode(CodeceptionTester $I): void
    {
        $exitCode = 123;

        $I->addCommand(ExitCodeCommand::class);

        $argv = [
            "cli.php",
            "exit-code",
            "--exit-code",
            (string) $exitCode,
        ];

        $returnedExitCode = $I->runCommand($argv);

        $I->assertEquals(
            $exitCode,
            $returnedExitCode
        );
    }



    public function testGrabExitCode(CodeceptionTester $I): void
    {
        $exitCode = 123;

        $I->addCommand(ExitCodeCommand::class);

        $argv = [
            "cli.php",
            "exit-code",
            "--exit-code",
            (string) $exitCode,
        ];

        $I->runCommand($argv);

        $I->assertEquals(
            $exitCode,
            $I->grabExitCode()
        );
    }

    public function testSeeExitCodeIs(CodeceptionTester $I): void
    {
        $exitCode = 0;

        $I->addCommand(ExitCodeCommand::class);

        $argv = [
            "cli.php",
            "exit-code",
            "--exit-code",
            (string) $exitCode,
        ];

        $I->runCommand($argv);

        $I->seeExitCodeIs(0);
    }

    public function testSeeExitCodeIsNot(CodeceptionTester $I): void
    {
        $exitCode = 0;

        $I->addCommand(ExitCodeCommand::class);

        $argv = [
            "cli.php",
            "exit-code",
            "--exit-code",
            (string) $exitCode,
        ];

        $I->runCommand($argv);

        $I->seeExitCodeIsNot(1);
    }

    public function testSeeStdoutEquals(CodeceptionTester $I): void
    {
        $I->seeStdoutEquals(
            ""
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStdoutEquals(
            "This is to STDOUT.123"
        );
    }

    public function testSeeStdoutNotEquals(CodeceptionTester $I): void
    {
        $I->seeStdoutNotEquals(
            "This is to STDERR.456"
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStdoutNotEquals(
            "This is to STDERR.456"
        );
    }

    public function testSeeStdoutContains(CodeceptionTester $I): void
    {
        $I->seeStdoutContains(
            ""
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStdoutContains(
            "STDOUT"
        );

        $I->seeStdoutContains(
            "123"
        );
    }

    public function testSeeStdoutNotContains(CodeceptionTester $I): void
    {
        $I->seeStdoutNotContains(
            "STDERR"
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStdoutNotContains(
            "STDERR"
        );

        $I->seeStdoutNotContains(
            "456"
        );
    }

    public function testSeeStderrEquals(CodeceptionTester $I): void
    {
        $I->seeStderrEquals(
            ""
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStderrEquals(
            "This is to STDERR.456"
        );
    }

    public function testSeeStderrNotEquals(CodeceptionTester $I): void
    {
        $I->seeStderrNotEquals(
            "This is to STDOUT.123"
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStderrNotEquals(
            "This is to STDOUT.123"
        );
    }

    public function testSeeStderrContains(CodeceptionTester $I): void
    {
        $I->seeStderrContains(
            ""
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStderrContains(
            "STDERR"
        );

        $I->seeStderrContains(
            "456"
        );
    }

    public function testSeeStderrNotContains(CodeceptionTester $I): void
    {
        $I->seeStderrNotContains(
            "STDOUT"
        );

        $argv = ["cli.php", "hello"];

        $terminal = $I->createTerminal($argv);

        $terminal->write("This is to STDOUT.");
        $terminal->writeError("This is to STDERR.");
        $terminal->write("123");
        $terminal->writeError("456");

        $I->seeStderrNotContains(
            "STDOUT"
        );

        $I->seeStderrNotContains(
            "123"
        );
    }
}
