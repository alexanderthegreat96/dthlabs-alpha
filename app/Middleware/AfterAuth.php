<?php
namespace LexSystems\Framework\Middlewares;

use LexSystems\Framework\Kernel\Helpers\CoreUtils\Utils;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use LexSystems\Framework\Kernel\Helpers\Requests;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;
use LexSystems\Framework\Kernel\Middleware;

class AfterAuth extends Middleware
{
    public function handle()
    {

        $session = new Session();

        if($session->getParam('logged_in'))
        {
            if($session->getParam('rank'))
            {
                switch ($session->getParam('rank'))
                {
                    case 'admin':
                        Requests::redirect('/admin');
                        break;
                    case 'moderator':
                        Requests::redirect('/moderator');
                        break;
                    default:
                        Requests::redirect('/');
                }

                return true;
            }
            else
            {
                Requests::redirect('/login');
            }
        }
        else
        {
            Requests::redirect('/login');
        }

        return true;
    }
}