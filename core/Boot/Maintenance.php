<?php
namespace LexSystems\Framework\Core\Boot;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Core\Kernel\View;

class Maintenance
{
    public static function init()
    {
        if(\LexSystems\Framework\Config\Kernel\Maintenance::ENABLED)
        {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: *');
            header('Access-Control-Allow-Headers: *');
            http_response_code(500);
            View::renderTemplate('maintenance.html');
            die(1);
        }
    }
}