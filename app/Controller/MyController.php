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

        DB::table('dth_auth_users')->insert
        (
            [
                'username' => Str::random(10).'_'.Str::random(2),
                'password' => Hash::make('password'),
                'first_name' =>  Str::random(10),
                'last_name' =>  Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'adress' => Str::random(20),
                'phone_number' => Str::random(10),
                'user_rank' => Str::words(5),
                'status' => Str::words(5),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
