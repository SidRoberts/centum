<?php

namespace Centum\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FormExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                "form_start",
                [$this, "formStart"],
                [
                    "is_safe" => ["html"],
                ]
            ),
            new TwigFunction(
                "form_end",
                [$this, "formEnd"],
                [
                    "is_safe" => ["html"],
                ]
            ),
        ];
    }



    public function formStart(string $method = "GET", string $action = ""): string
    {
        $method = mb_strtoupper($method);

        $formMethod = ($method === "GET") ? "GET" : "POST";

        $html = sprintf(
            "<form method=\"%s\" action=\"%s\">",
            htmlspecialchars($formMethod, \ENT_QUOTES, "UTF-8"),
            htmlspecialchars($action, \ENT_QUOTES, "UTF-8")
        );

        // HTML forms only support sending via GET and POST.
        if (!in_array($method, ["GET", "POST"], true)) {
            $html .= PHP_EOL . sprintf(
                "<input type=\"hidden\" name=\"_method\" value=\"%s\">",
                htmlspecialchars($method, \ENT_QUOTES, "UTF-8")
            );
        }

        return $html;
    }

    public function formEnd(): string
    {
        return "</form>";
    }
}
