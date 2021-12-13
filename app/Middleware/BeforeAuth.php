<?php
namespace LexSystems\Framework\Middlewares;
use LexSystems\Framework\Kernel\Middleware;

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