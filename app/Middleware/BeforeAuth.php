<?php
namespace LexSystems\Framework\Middlewares;
use LexSystems\Framework\Kernel\Helpers\Requests;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;
use LexSystems\Framework\Kernel\Middleware;

class BeforeAuth extends Middleware
{
    public function handle()
    {
        $session = new Session();

        if($session->getParam('logged_in'))
        {
            return true;
        }
        else
        {
            Requests::redirect('/login');
        }

        return true;
    }
}