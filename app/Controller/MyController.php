<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;

class MyController extends Controller
{
    public function indexAction()
    {
        $this->view()->renderTemplate('index',[]);
        $this->dd(['myVar' => 'Something','somethingRequest' => $this->request()->hasArgument('something')]);
    }
}
