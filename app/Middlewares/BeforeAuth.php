<?php
namespace App\Middlewares;
use LexSystems\Framework\Core\Kernel\Middleware;
/**
 * Example middleware
 * Checks if the user is logged in by
 * grabbing the session params
 */
class BeforeAuth extends Middleware
{
    public function handle()
    {
        if($this->session->getParam('logged_in'))
        {
           return true;
        }
        else
        {
            $this->request->redirect('/login');
        }
    }
}