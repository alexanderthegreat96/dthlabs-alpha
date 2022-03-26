<?php
namespace LexSystems\Framework\Core;

use LexSystems\Core\App\FileSystem;
use LexSystems\Core\App\Request;
use LexSystems\Core\App\Session;
use LexSystems\Core\System\Extend\Captcha;
use LexSystems\Core\System\Extend\Validation;
use LexSystems\Core\System\Helpers\Arrays\ArrayUtility;
use LexSystems\Core\System\Helpers\CoreUtils\Hash;
use LexSystems\Core\System\Helpers\CoreUtils\SqlFormatter;
use LexSystems\Core\System\Helpers\CoreUtils\Utils;
use LexSystems\Core\System\Helpers\Database\IlluminateDb;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Core\System\Helpers\Utils\ArrayForm;
use LexSystems\Core\System\Helpers\Utils\LoremIpsum;
use LexSystems\Framework\Config\App\Config;
use LexSystems\Framework\Config\Database\MysqlConfig;
use LexSystems\Framework\Config\Kernel\Error;
use LexSystems\Framework\Config\Kernel\Maintenance;
use LexSystems\Framework\Config\Mail\Mail;
use LexSystems\Framework\Core\Kernel\Controller;
use LexSystems\Framework\Core\Kernel\Middleware;
use LexSystems\Framework\Core\Kernel\Model;
use LexSystems\Framework\Core\Kernel\Route;
use LexSystems\Framework\Core\Kernel\View;

class Aliases
{
    /**
     * Alias for the most important classes
     */
    public static function init()
    {
        class_alias(Route::class,'Core\Route');
        class_alias(Model::class,'Core\Model');
        class_alias(IlluminateDb::class, 'Core\IlluminateDb');
        class_alias(Request::class,'Core\Request');
        class_alias(Middleware::class,'Core\Middleware');
        class_alias(Controller::class,'Core\Controller');
        class_alias(View::class,'Core\View');
        class_alias(Session::class,'Core\Session');
        class_alias(FileSystem::class,'Core\FileSystem');
        class_alias(SqlFormatter::class,'Core\SqlFormatter');
        class_alias(Hash::class,'Core\Hash');
        class_alias(Utils::class,'Core\CoreUtils');
        class_alias(Debugger::class,'Core\Debugger');
        class_alias(ArrayUtility::class,'Core\ArrayUtility');
        class_alias(LoremIpsum::class,'Core\LoremIpsum');
        class_alias(ArrayForm::class,'Core\ArrayForm');
        class_alias(Validation::class,'Core\Validation');
        class_alias(Captcha::class,'Core\Captcha');

    }
}