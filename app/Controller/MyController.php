<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;

class MyController extends Controller
{
    public function indexAction()
    {
        $args = [];
        $this->system()->view()->renderTemplate('my_template',[]);
        $this->system()->dd('');
    }
}
