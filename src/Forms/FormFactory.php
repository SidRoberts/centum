<?php

namespace Centum\Forms;

use Centum\Interfaces\Forms\FormInterface;

class FormFactory
{
    public function createFromTemplate(FormTemplate $template): FormInterface
    {
        $form = new Form();

        /** @var list<non-empty-string> */
        $methods = get_class_methods($template);

        foreach ($methods as $method) {
            if ($method === "__construct") {
                continue;
            }

            /** @var callable */
            $callable = [
                $template,
                $method,
            ];

            $field = new Field($method);

            call_user_func_array(
                $callable,
                [
                    $field,
                ]
            );

            $form->add($field);
        }

        return $form;
    }
}
