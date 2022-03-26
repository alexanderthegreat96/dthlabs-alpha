<?php
namespace dthauth\Schemas;
use LexSystems\Core\System\Helpers\Database\Migrations;
use LexSystems\Core\System\Helpers\Database\Blueprint;
class Schema
{
    public static function up()
    {
        Migrations::create('users', function (Blueprint $table) {
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

    public static function down()
    {
        Migrations::dropIfExists('users');
    }

}