<?php
namespace LexSystems\Framework\Controllers;
use LexSystems\Framework\Kernel\Controller;
use Gherkins\RegExpBuilderPHP\RegExpBuilder;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use Symfony\Component\VarDumper\VarDumper;
class MyController extends Controller
{
    public function indexAction()
    {
        echo $this->loremIpsum()->sentences(10);

        $this->view()->renderTemplate('index',[]);
//        $this->dd(['myVar' => 'Something','somethingRequest' => $this->request()->hasArgument('something')]);

    }
}
