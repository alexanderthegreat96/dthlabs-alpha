<?php
namespace LexSystems\Framework\Configs\App;
class Config
{

    const MyConst = 'myvalue';

    /**
     * Put whatever constants you want in here
     */

    public static function getParam(string $param)
    {
        return self::$param;
    }
}
