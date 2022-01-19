<?php
namespace LexSystems\Framework\Configs\Database;
class MysqlConfig
{
    /**
     * Configuration parameters
     * for MYSQL
     */

    const MYSQL_HOST = '192.168.1.69';
    const MYSQL_USER = 'alexander';
    const MYSQL_PASS = 'thelexus2356';
    const MYSQL_DB = 'dth-labs-alpha';

    /**
     * @return string
     */
    public static function getHost()
    {
        return self::MYSQL_HOST;
    }
    /**
     * @return string
     */
    public static function getUser()
    {
        return self::MYSQL_USER;
    }
    /**
     * @return string
     */
    public static function getPass()
    {
        return self::MYSQL_PASS;
    }
    /**
     * @return string
     */
    public static function getDb()
    {
        return self::MYSQL_DB;
    }
}