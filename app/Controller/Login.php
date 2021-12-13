<?php
namespace LexSystems\Framework\Controllers;
use Doctrine\Common\Util\Debug;
use LexSystems\Framework\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;

class Login extends Controller
{
    public function indexAction()
    {
        return 'login page';
    }
}