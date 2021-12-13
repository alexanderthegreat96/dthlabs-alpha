<?php
namespace LexSystems\Framework\Kernel;

/**
 * Use public function handle in all middlewares
 */

abstract class Middleware extends  \Buki\Router\Http\Middleware
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

    public function __construct()
    {
        $system = new System();
        $this->utils = $system->utils();
        $this->request = $system->request();
        $this->session = $system->session();
        $this->system = $system;
    }
}
