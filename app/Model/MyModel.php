<?php
namespace LexSystems\Framework\Models;
use LexSystems\Framework\Kernel\Model;

class MyData extends Model
{
   // protected $table = 'my_data';
    protected $fillable = ['first_name','last_name','company_name','car_make','car_model'];
}