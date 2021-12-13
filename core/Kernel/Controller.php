<?php
/**
 * Route handler
 * Controller
 */
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\System;

class Controller extends \Buki\Router\Http\Controller
{
    /**
     * @var Helpers\CoreUtils\Utils
     */
    protected $utils;
    /**
     * @var Helpers\Requests
     */
    protected $request;
    /**
     * @var Helpers\Sesssions\Session
     */
    protected $session;
    /**
     * @var \LexSystems\Framework\Kernel\System
     */
    protected $system;
    /**
     * @var View
     */
    protected $view;


    public function __construct()
    {
        $system  = new System();
        $this->utils = $system->utils();
        $this->request = $system->request();
        $this->session = $system->session();
        $this->system = $system;
        $this->view = $system->view();
    }
}
