<?php
namespace App\Middlewares;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Utils;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use LexSystems\Framework\Kernel\Helpers\Requests;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;
use LexSystems\Framework\Core\Kernel\Middleware;

class AfterAuth extends Middleware
{
    public function handle()
    {
        if($this->session->getParam('logged_in'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}