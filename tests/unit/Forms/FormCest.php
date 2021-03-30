<?php

namespace Tests\Forms;

use Centum\Forms\Field;
use Centum\Forms\Form;
use Tests\UnitTester;
use Laminas\Validator\NotEmpty;

class FormCest
{
    public function getters(UnitTester $I): void
    {
        $form = new Form();

        $field = new Field("thisIsTheName");

        $status = $form->validate(
            []
        );

        $I->assertEquals(
            [],
            $status->getMessages()
        );
    }

    public function emptyForm(UnitTester $I): void
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

    public function actualForm(UnitTester $I): void
    {
        $form = new Form();

        $field = new Field("exampleField");



        $notEmptyValidator = new NotEmpty();

        $field->addValidator($notEmptyValidator);



        $form->add($field);



        $status = $form->validate(
            [
                "exampleField" => "This is not empty.",
            ]
        );

        $I->assertTrue(
            $status->isValid()
        );

        $I->assertEquals(
            [],
            $status->getMessages()
        );



        $status = $form->validate(
            []
        );

        $I->assertFalse(
            $status->isValid()
        );

        $I->assertEquals(
            [
                "exampleField" => [
                    "isEmpty" => "Value is required and can't be empty",
                ],
            ],
            $status->getMessages()
        );



        $status = $form->validate(
            [
                "exampleField" => "",
            ]
        );

        $I->assertFalse(
            $status->isValid()
        );

        $I->assertEquals(
            [
                "exampleField" => [
                    "isEmpty" => "Value is required and can't be empty",
                ],
            ],
            $status->getMessages()
        );



        $status = $form->validate(
            [
                "exampleField" => "This is not empty.",
            ]
        );

        $I->assertTrue(
            $status->isValid()
        );

        $I->assertEquals(
            [],
            $status->getMessages()
        );
    }
}
