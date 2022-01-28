<?php
namespace App\Models;
use LexSystems\Framework\Core\Kernel\Model;
class DthAuthUsers extends Model
{
    protected $table = "dth_auth_users";
    protected $fillable = ["id","username","password","first_name","last_name","email","adress","phone_number","user_rank","status","created_at","updated_at"];
}
?>