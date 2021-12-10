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
        $requests = new Requests();
        $session = new Session();

        if($session->getParam('logged_in'))
        {
            if($session->getParam('rank'))
            {
                switch ($session->getParam('rank'))
                {
                    case 'admin':
                        $requests::redirect('/admin');
                        break;
                    case 'moderator':
                        $requests::redirect('/moderator');
                        break;
                    default:
                        $requests::redirect('/');
                }

                return true;
            }
            else
            {
                $requests::redirect('/login');
            }
        }
        else
        {
            $requests::redirect('/login');
        }

        return true;
    }
}