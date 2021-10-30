<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;

class MyController extends Controller
{
    public function myActionNameAction()
    {
        $args = [];
        $this->view()->renderTemplate('mytemplate',[]);
    }
}
