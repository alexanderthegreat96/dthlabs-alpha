<?php
namespace LexSystems\Framework\Controllers;
use Illuminate\Support\Str;
use LexSystems\Core\System\Extend\Validation;
use LexSystems\Core\System\Helpers\Debugger\Debugger;
use LexSystems\Framework\Kernel\Controller;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Hash;
use LexSystems\Core\System\Helpers\Database\DB;
class MyController extends Controller
{
    public function indexAction()
    {
        Debugger::var_dump($this->request->getArguments());

        $test = DB::table('dth_auth_users')->paginate('15');
        Debugger::var_dump( Validation::validate([],[]));
    }
}
