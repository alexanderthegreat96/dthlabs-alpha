<?php
/**
 * Route handler
 * Controller
 */
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\System;

class Controller extends \Buki\Router\Http\Controller
{
    protected $utils;
    protected $request;
    protected $session;
    protected $system;

    public function __construct()
    {
        $system  = new System();
        $this->utils = $system->utils();
        $this->request = $system->request();
        $this->session = $system->session();
        $this->system = $system;

    }
}
