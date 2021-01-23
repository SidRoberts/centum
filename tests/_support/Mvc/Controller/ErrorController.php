<?php

namespace Centum\Tests\Mvc\Controller;

use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Uri;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    #[Uri("/error/404")]
    public function notFound()
    {
        return new Response(
            "not found",
            RESPONSE::HTTP_NOT_FOUND
        );
    }
}
