<?php

namespace Buki\Tests\Example\Middlewares;

use Buki\Router\Http\Middleware;

class TestMiddleware extends Middleware
{
    public function handle(string $name = 'emre', int $age = 25): bool
    {
        echo $name . '-' . $age;
        return true;
    }
}