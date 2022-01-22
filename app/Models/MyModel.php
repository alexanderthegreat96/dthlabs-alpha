<?php
namespace App\Models;
use LexSystems\Framework\Core\Kernel\Model;
class MyModel extends Model
{
   // protected $table = 'my_data';
    protected $fillable = ['first_name','last_name','company_name','car_make','car_model'];
}