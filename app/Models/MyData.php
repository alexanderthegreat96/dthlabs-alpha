<?php
namespace App\Models;
use LexSystems\Framework\Core\Kernel\Model;
class MyData extends Model
{
    protected $table = "my_data";
    protected $fillable = ["id","first_name","last_name","company_name","car_make","car_model","updated_at","created_at"];
}
?>