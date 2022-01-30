<?php
namespace App\Controllers;
use App\Models\DthAuthUsers;
use App\Models\Users;
use LexSystems\Core\System\Helpers\CoreUtils\Hash;
use LexSystems\Framework\Core\Kernel\Controller;
class MyController extends Controller
{
    public function indexAction()
    {
        return 'This is the default controller!';
    }
}
