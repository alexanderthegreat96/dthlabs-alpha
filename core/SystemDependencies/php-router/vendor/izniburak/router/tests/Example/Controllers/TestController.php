<?php

namespace Buki\Tests\Example\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function main(): string
    {
        return 'controller route';
    }

    public function foo(Response $response): Response
    {
        $response->setContent('Foo in TestController!');

        return $response;
    }
}
