<?php
namespace App\Models;
use Core\Model;
class Users extends Model
{
    protected $table = "users";
    protected $fillable = ["id","username","password","first_name","last_name","address","phone_number","company","rank","created_at","updated_at"];
}
?>