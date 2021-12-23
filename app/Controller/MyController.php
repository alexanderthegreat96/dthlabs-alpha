<?php
namespace LexSystems\Framework\Controllers;
use Illuminate\Support\Str;
use LexSystems\Framework\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Hash;
use LexSystems\Framework\Kernel\Helpers\Database\DB;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
class MyController extends Controller
{
    public function indexAction()
    {
        Debugger::var_dump($this->request->getArguments());

        $test = DB::table('dth_auth_users')->get();

        Debugger::var_dump($test);
    }
}
