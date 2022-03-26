<?php
namespace App\Controllers;
use Core\Controller;
use Core\View;
use Core\Debugger;
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