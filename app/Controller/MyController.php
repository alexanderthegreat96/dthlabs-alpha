<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;

class MyController extends Controller
{
    public function myActionNameAction()
    {
        $this->var_dump($this->sessions()->getSession());
        //$this->view()->renderTemplate('mytemplate',[]);
    }
}
