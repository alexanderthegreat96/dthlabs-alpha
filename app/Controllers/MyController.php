<?php
namespace App\Controllers;
use App\Models\DthAuthUsers;
use App\Models\Users;
use LexSystems\Core\System\Extend\Captcha;
use LexSystems\Core\System\Helpers\CoreUtils\Hash;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\Controller;
class MyController extends Controller
{
    public function indexAction()
    {
        $code = Captcha::makeCode();
        if($code['status'])
        {
            $image = Captcha::makeImage($code['code']);
            if($image['status'])
            {
                echo '<img src="'.$image['img_src'].'">';
            }
        }
    }
}
