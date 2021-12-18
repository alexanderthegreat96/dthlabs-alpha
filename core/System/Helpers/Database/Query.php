<?php
namespace LexSystems\Framework\Kernel\Helpers\CoreUtils;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use LexSystems\Framework\Configs\Database\MysqlConfig;

class Query
{
    /**
     * Query Constructor
     */
    public function __construct()
    {
        $this->connectionParam =
            [
                'dbname' =>  MysqlConfig::getDb(),
                'user' => MysqlConfig::getUser(),
                'password' => MysqlConfig::getPass(),
                'host' => MysqlConfig::getHost(),
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
