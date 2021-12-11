<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;

class MyController extends Controller
{
    public function indexAction()
    {
        Debugger::var_dump($this->request()->getArguments());
        $this->requests->getArguments();
    }
}
