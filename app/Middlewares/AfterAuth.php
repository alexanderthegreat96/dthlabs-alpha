<?php
namespace App\Middlewares;
use LexSystems\Framework\Core\Kernel\Middleware;
use LexSystems\Core\System\Helpers\Debugger;
class AfterAuth extends Middleware
{
    public function handle()
    {
        if($this->session->getParam('rank') && $this->session->getParam('rank') == 'admin')
        {
            return '';
        }
        else
        {
            $this->request->redirect('/');
        }
    }
}