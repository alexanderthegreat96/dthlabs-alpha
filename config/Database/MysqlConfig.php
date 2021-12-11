<?php
namespace LexSystems\Framework\Configs\Database;
class MysqlConfig
{
    /**
     * Configuration parameters
     * for MYSQL
     */

    const MYSQL_HOST = 'host';
    const MYSQL_USER = 'user';
    const MYSQL_PASS = 'pass';
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