<?php
namespace LexSystems\Framework\Core\bin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LexSystems\Framework\Kernel\Helpers\Database\DB;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\RandomSeeder;
class DatabaseSeeder extends Seeder
{
    public static function run()
    {
        $seeder = new RandomSeeder();

        DB::table('dth_auth_users')->insert
        (
            [
                'username' => Str::lower($seeder->LastName().'_'.rand(1,10)),
                'password' => \LexSystems\Framework\Kernel\Helpers\CoreUtils\Hash::make('password'),
                'first_name' =>  $seeder->FirstName(),
                'last_name' => $seeder->LastName(),
                'email' => Str::lower($seeder->Name().'_'.rand(1,10)).'@gmail.com',
                'adress' => $seeder->State(),
                'phone_number' => Str::random(10),
                'user_rank' => 'user',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

    }
}