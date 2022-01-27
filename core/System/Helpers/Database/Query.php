<?php
namespace LexSystems\Core\System\Helpers\CoreUtils;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use LexSystems\Framework\Config\Database\MysqlConfig as Config;
class Query
{
    /**
     * Query Constructor
     */
    public function __construct()
    {
        $this->connectionParam =
            [
                'dbname' =>  Config::MYSQL_DB,
                'user' => Config::MYSQL_USER,
                'password' => Config::MYSQL_PASS,
                'host' => Config::MYSQL_HOST,
                'driver' => 'mysqli',
            ];
    }

    /**
     * @return QueryBuilder|string
     */
    public function queryBuilder()
    {
        try{
            $conn = DriverManager::getConnection($this->connectionParam);
            return $conn->createQueryBuilder();
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}
