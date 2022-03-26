<?php

namespace Buki\Tests\Example\Controllers;

use Buki\Router\Http\Controller;

class FooController extends Controller
{
    public function __invoke(): string
    {
        return 'Hello from Invoke!';
    }
}