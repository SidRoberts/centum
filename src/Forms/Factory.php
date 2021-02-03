<?php

namespace Centum\Forms;

class Factory
{
    public static function build(FormTemplate $template) : Form
    {
        $form = new Form();

        $methods = get_class_methods($template);

        foreach ($methods as $method) {
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
