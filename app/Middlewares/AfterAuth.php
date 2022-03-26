<?php
namespace App\Middlewares;
use LexSystems\Framework\Config\App\Config;
use LexSystems\Framework\Core\Kernel\Middleware;

class AfterAuth extends Middleware
{
    public function handle()
    {
        if($this->session->hasParam('rank'))
        {
            $rank = $this->session->getParam('rank');
            if(!in_array($rank,['admin','root']))
            {
                $this->request->redirect(Config::APP_URL.'/');
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}