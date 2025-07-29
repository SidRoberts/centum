<?php

namespace Tests\Support\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

final class HtmlController implements ControllerInterface
{
    public function index(): ResponseInterface
    {
        return new Response(
            "<html>
            <head>
            <title>hello</title>
            </head>

            <body>
            <img src='logo.png' id='logo'>
            <blockquote>This is a quote.</blockquote>
            </body>
            </html>"
        );
    }

    public function withoutTitle(): ResponseInterface
    {
        return new Response(
            "<html>
            <head>
            </head>

            <body>
            <img src='logo.png' id='logo'>
            <blockquote>This is a quote.</blockquote>
            </body>
            </html>"
        );
    }

    public function withoutHtml(): ResponseInterface
    {
        return new Response(
            ""
        );
    }
}
