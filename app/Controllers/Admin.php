<?php
namespace App\Controllers;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\Controller;

class Admin extends Controller
{
    public function indexAction()
    {
        /**
         * Admin controller
         */
        Debugger::var_dump($this->request->getArguments());
        return 'hello world';
    }
}