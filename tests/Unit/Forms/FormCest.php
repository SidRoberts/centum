<?php

namespace Tests\Unit\Forms;

use Centum\Forms\Field;
use Centum\Forms\Form;
use Centum\Validator\NotEmpty;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\UnitTester;

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



    #[DataProvider("providerActualForm")]
    public function testActualForm(UnitTester $I, Example $example): void
    {
        $field = new Field("exampleField");

        $notEmptyValidator = new NotEmpty();

        $field->addValidator($notEmptyValidator);



        $form = new Form();

        $form->add($field);



        /** @var array */
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
