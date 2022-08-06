<?php

namespace Centum\Forms;

class FormFactory
{
    public function createFromTemplate(FormTemplate $template): Form
    {
        $form = new Form();

        $methods = get_class_methods($template);

        foreach ($methods as $method) {
            if ($method === "__construct") {
                continue;
            }

            $field = new Field($method);

            call_user_func_array(
                [
                    $template,
                    $method,
                ],
                [
                    $field,
                ]
            );

            $form->add($field);
        }

        return $form;
    }
}
