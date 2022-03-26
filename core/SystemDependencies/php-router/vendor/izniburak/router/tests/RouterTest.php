<?php

namespace Buki\Tests;

use Buki\Router\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RouterTest extends TestCase
{
    protected $router;

    protected $request;

    protected function setUp(): void
    {
        error_reporting(E_ALL);
        $this->request = Request::createFromGlobals();
        $this->router = new Router(
            [],
            $this->request
        );

        // Clear SCRIPT_NAME because bramus/router tries to guess the subfolder the script is run in
        $this->request->server->set('SCRIPT_NAME', '/index.php');
        $this->request->server->set('SCRIPT_FILENAME', '/index.php');

        // Default request method to GET
        $this->request->server->set('REQUEST_METHOD', 'GET');

        // Default SERVER_PROTOCOL method to HTTP/1.1
        $this->request->server->set('SERVER_PROTOCOL', 'HTTP/1.1');
    }

    protected function tearDown(): void
    {
        // nothing
    }

    public function testInit()
    {
        $this->assertInstanceOf('\Buki\Router\Router', $this->router);
    }

    public function testRouteCount()
    {
        $this->router->get('/', 'HomeController@main');
        $this->router->get('/contact', 'HomeController@contact');
        $this->router->get('/about', 'HomeController@about');

        $this->assertCount(3, $this->router->getRoutes(), "doesn't contains 2 routes");
    }

    public function testRequestMethods()
    {
        $this->router->get('/get', function () {
            return 'get';
        });
        $this->router->post('/post', function () {
            return 'post';
        });
        $this->router->put('/put', function () {
            return 'put';
        });
        $this->router->patch('/', function () {
            return 'patch';
        });
        $this->router->delete('/', function () {
            return 'delete';
        });
        $this->router->options('/', function () {
            return 'options';
        });

        // Test GET
        ob_start();
        $this->request->server->set('REQUEST_URI', '/get');
        $this->request->server->set('REQUEST_METHOD', 'GET');
        $this->router->run();
        $this->assertEquals('get', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testDynamicRequestUri()
    {
        $this->router->get('/test/:id', function (int $id) {
            return "result: {$id}";
        });

        $this->router->get('/test/:string', function (string $username) {
            return "result: {$username}";
        });

        $this->router->get('/test/:uuid', function (string $uuid) {
            return "result: ce3a3f47-b950-4e34-97ee-fa5f127d4564";
        });

        $this->router->get('/test/:date', function (string $date) {
            return "result: 1938-11-10";
        });

        $this->request->server->set('REQUEST_METHOD', 'GET');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test/10');
        $this->router->run();
        $this->assertEquals('result: 10', ob_get_contents());

        ob_clean();
        $this->request->server->set('REQUEST_URI', '/test/izniburak');
        $this->router->run();
        $this->assertEquals('result: izniburak', ob_get_contents());

        ob_clean();
        $this->request->server->set('REQUEST_URI', '/test/ce3a3f47-b950-4e34-97ee-fa5f127d4564');
        $this->router->run();
        $this->assertEquals('result: ce3a3f47-b950-4e34-97ee-fa5f127d4564', ob_get_contents());

        ob_clean();
        $this->request->server->set('REQUEST_URI', '/test/1938-11-10');
        $this->router->run();
        $this->assertEquals('result: 1938-11-10', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testPostRequestMethod()
    {
        $this->router->post('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'POST');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testPutRequestMethod()
    {
        $this->router->put('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'PUT');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testDeleteRequestMethod()
    {
        $this->router->delete('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'DELETE');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testPatchRequestMethod()
    {
        $this->router->patch('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'PATCH');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testOptionsRequestMethod()
    {
        $this->router->options('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'OPTIONS');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testXGetRequestMethod()
    {
        $this->router->xget('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'XGET');
        $this->request->server->set('X-Requested-With', 'XMLHttpRequest');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }

    public function testXPostRequestMethod()
    {
        $this->router->xpost('/test', function () {
            return "success";
        });

        $this->request->server->set('REQUEST_METHOD', 'XPOST');
        $this->request->server->set('X-Requested-With', 'XMLHttpRequest');

        ob_start();
        $this->request->server->set('REQUEST_URI', '/test');
        $this->router->run();
        $this->assertEquals('success', ob_get_contents());

        // Cleanup
        ob_end_clean();
    }
}
