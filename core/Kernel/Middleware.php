<?php
namespace LexSystems\Framework\Kernel;

/**
 * Use public function handle in all middlewares
 */

abstract class Middleware extends  \Buki\Router\Http\Middleware
{
    protected $request;
    protected $session;
    protected $system;

    public function __construct()
    {
        $system = new System();
        $this->request = $system->request();
        $this->session = $system->session();
        $this->system = $system;
    }
}
