<?php

namespace Tests\Unit\Forms;

use Centum\Filter\Callback;
use Centum\Filter\String\ToLower;
use Centum\Forms\Field;
use Centum\Forms\Form;
use Centum\Validator\NotEmpty;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Forms\Form
 */
class FormCest
{
    public function testEmptyForm(UnitTester $I): void
    {
        $form = new Form();

        $status = $form->validate(
            []
        );

        $I->assertTrue(
            $status->isValid()
        );

        $I->assertEquals(
            [],
            $status->getMessages()
        );
    }



    public function testGetFilteredValues(UnitTester $I): void
    {
        $data = [
            "name"     => "  sid  roberts ",
            "username" => "SidRoberts",
            "password" => "hunter2",
        ];

        $nameField = new Field("name");

        $nameField->addFilter(
            new Callback(
                function (string $value): string {
                    $value = trim($value);
                    $value = preg_replace("/\s+/", " ", $value);
                    $value = ucwords(strtolower($value));

                    return $value;
                }
            )
        );

        $usernameField = new Field("username");

        $usernameField->addFilter(
            new ToLower()
        );

        $passwordField = new Field("password");

        $optionalField = new Field("optional");

        $form = new Form();

        $form->add($nameField);
        $form->add($usernameField);
        $form->add($passwordField);
        $form->add($optionalField);

        $I->assertEquals(
            [
                "name"     => "Sid Roberts",
                "username" => "sidroberts",
                "password" => "hunter2",
                "optional" => null,
            ],
            $form->getFilteredValues($data)
        );
    }



    #[DataProvider("providerActualForm")]
    public function testActualForm(UnitTester $I, Example $example): void
    {
        $field = new Field("exampleField");

        $notEmptyValidator = new NotEmpty();

        $field->addValidator($notEmptyValidator);



        $form = new Form();

        $form->add($field);



        /** @var array<string, mixed> */
        $data = $example["data"];

        $status = $form->validate($data);



        /** @var bool */
        $isValid = $example["isValid"];

        $I->assertEquals(
            $isValid,
            $status->isValid()
        );



        /** @var array */
        $messages = $example["messages"];

        $I->assertEquals(
            $messages,
            $status->getMessages()
        );
    }

    protected function providerActualForm(): array
    {
        return [
            [
                "data"     => [],
                "isValid"  => false,
                "messages" => [
                    "exampleField" => [
                        "Value is required and can't be empty.",
                    ],
                ],
            ],

            [
                "data" => [
                    "exampleField" => "",
                ],
                "isValid"  => false,
                "messages" => [
                    "exampleField" => [
                        "Value is required and can't be empty.",
                    ],
                ],
            ],

            [
                "data" => [
                    "exampleField" => "This is not empty.",
                ],
                "isValid"  => true,
                "messages" => [],
            ],
        ];
    }
}
