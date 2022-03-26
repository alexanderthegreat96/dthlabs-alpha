<?php
namespace App\Models;
use LexSystems\Framework\Core\Kernel\Model;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string[]
     */

    protected $fillable =
        [
            'username',
            'password',
            'email',
            'first_name',
            'last_name',
            'address',
            'phone_number',
            'company',
            'rank',
            'created_at',
            'updated_at'
        ];
}