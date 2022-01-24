<?php
namespace App\Controllers;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\Controller;

class Files extends Controller
{
    public function uploadFilesAction()
    {
        Debugger::var_dump($this->request->getArguments());
    }
}