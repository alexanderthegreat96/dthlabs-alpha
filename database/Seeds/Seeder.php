<?php
namespace LexSystems\Framework\Database;
use Illuminate\Support\Str;
use LexSystems\Core\System\Helpers\Database\IlluminateDb;
use LexSystems\Core\System\Helpers\CoreUtils\RandomSeeder;
use LexSystems\Core\System\Helpers\CoreUtils\Hash;
class Seeder
{
    public static function run()
    {
        $seeder = new RandomSeeder();
        IlluminateDb::table('users')->insert
        (
            [
                'username' => Str::lower($seeder->LastName().'_'.rand(1,10)),
                'password' => Hash::make('password'),
                'first_name' =>  $seeder->FirstName(),
                'last_name' => $seeder->LastName(),
                'address' => $seeder->State(),
                'phone_number' => Str::random(10),
                'company' => $seeder->State(),
                'rank' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}