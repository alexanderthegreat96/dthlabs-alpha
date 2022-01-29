<?php
namespace LexSystems\Framework\Database;
use Illuminate\Database\Schema\Blueprint;
use LexSystems\Core\System\Helpers\Database\IlluminateDb;

class Migrations
{
    public static function upDb()
    {
        IlluminateDb::schema()->createDatabase('users');
    }
    public static function up()
    {
        /**
         * Create users
         */

         IlluminateDb::schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username', 45);
                $table->string('password', 100);
                $table->string('first_name', 30);
                $table->string('last_name', 30);
                $table->string('address', 50);
                $table->string('phone_number', 10);
                $table->string('company', 25);
                $table->string('rank', 7);
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });
    }

    public static function update()
    {
        /*
         * Update users
         */
        IlluminateDb::schema()->table('users',function (Blueprint $table)
        {
            $table->string('email',14)->after('password');
        });
    }

    public static function down()
    {
       IlluminateDb::schema()->dropIfExists('users');
    }

}
