<?php

namespace Tests\Unit\Console;

use Centum\Console\CommandMetadata;
use Centum\Console\Exception\InvalidCommandNameException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Console\CommandMetadata
 */
final class CommandMetadataCest
{
    public function testInvalidName(UnitTester $I): void
    {
        $name = "not a valid command name";

        $I->expectThrowable(
            InvalidCommandNameException::class,
            function () use ($name): void {
                new CommandMetadata($name);
            }
        );
    }

    public function testGetName(UnitTester $I): void
    {
        $name        = "list";
        $description = "This is the description of this command.";

        $commandMetadata = new CommandMetadata($name, $description);

        $I->assertEquals(
            $name,
            $commandMetadata->getName()
        );
    }

    public function testGetDescription(UnitTester $I): void
    {
        $name        = "list";
        $description = "This is the description of this command.";

        $commandMetadata = new CommandMetadata($name, $description);

        $I->assertEquals(
            $description,
            $commandMetadata->getDescription()
        );
    }

    public function testGetDescriptionEmpty(UnitTester $I): void
    {
        $commandMetadata = new CommandMetadata("list");

        $I->assertEquals(
            "",
            $commandMetadata->getDescription()
        );
    }
}
