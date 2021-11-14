<?php
namespace LexSystems\Framework\Configs\Kernel;
class Error
{
    /**
     * enables or disables
     * development errors
     */
    const ERROR_REPORTING = true;

    public static function getErrorReporting()
    {
        return self::ERROR_REPORTING;
    }
}
