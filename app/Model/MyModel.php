<?php
namespace LexSystems\Framework\Models;
use LexSystems\Framework\Kernel\Model;

class MyModel extends Model
{
    public function getUser(int $userId)
    {
        $con = $this->system()->mysqli()->connect();
        $get = mysqli_query($con,'SELECT * FROM users WHERE id = "'.$this->utils()->clean($userId).'" LIMIT 1');
        if(mysqli_num_rows($get))
        {
            return mysqli_fetch_assoc($get);
        }
        else
        {
            return false;
        }
    }
}