<?php
namespace LexSystems\Core\System\Helpers\Database;
use LexSystems\Framework\Configs\Database\MysqlConfig;

/**
 * Database Connection Class
 * Connect the the database
 * (c) 2021 Alexandru Lupaescu
 */

class MySqli
{
    /**
     * Initiate the MySQL Connection Here
     */

    public function connect(string $dbName = "")
    {
        if($dbName)
        {
            $connection = mysqli_connect(MysqlConfig::getHost(),MysqlConfig::getUser(),MysqlConfig::getPass(),$dbName);
        }
        else
        {
            $connection = mysqli_connect(MysqlConfig::getHost(),MysqlConfig::getUser(),MysqlConfig::getPass(),MysqlConfig::getDb());
        }

        if($connection)
        {
            /**
             * Deal with romanian characters
             */

            mysqli_set_charset( $connection, 'utf8'); 
            mysqli_query($connection,"SET NAMES 'utf8'");
            mb_internal_encoding('UTF-8');

            /**
             * Return the connection link
             */
            return $connection;
        }
        else
        {
            throw new Exception('Unable to connect to the MySQL Server');
        }
    }

    /**
     * @param string $table
     * @param array $columns
     * @param array $values
     * @param string $dbName
     * @return array
     */
    public function insertData(string $table = '', array $columns = [], array $values = [], string $dbName = '')
    {

        $con = $this->connect($dbName);
        $column_count = count($columns);
        $overwriteArr = array_fill(0, $column_count, '?');

        for ($i = 0; $i < sizeof($columns); $i++) {
            $columns[$i] = trim($columns[$i]);
            $columns[$i] = '`' . $columns[$i] . '`';
        }

        $query = "INSERT INTO {$table} (" . implode(',', $columns) . ") VALUES (" .
            implode(',', $overwriteArr) . ")";

        foreach ($values as $value) {
            $value = trim($value);
            $value = mysqli_real_escape_string($con, $value);
            $value = '"' . $value . '"';
            $query = preg_replace('/\?/', $value, $query, 1);
        }
        $result = mysqli_query($con, $query);

        if ($result) {
            return mysqli_insert_id($con);
        } else {
            throw new \Exception('There was a problem running the query. MySQL Error:'.mysqli_error($con).'SQL Code:'.$query);
        }
    }

    /**
     * Update Mysql Data
     * @array of cols
     * @array of values
     * @array containing criteria
     * ex: criteria : array("id" => "11", "name" => "alexander")
     */
    public function updateData(string $table, array $criteria, array $cols, array $vals,string $dbName = "")
    {
        $con = $this->connect($dbName);

        if (count($cols) == count($vals)) {
            $begin_query = "UPDATE " . $table . " SET ";

            foreach ($cols as $col_key => $col_value) {
                $value = $vals[$col_key];
                $value = mysqli_real_escape_string($con, $value);
                $values[] = " `" . $col_value . "` = '" . $value . "' ";
            }

            $begin_query .= implode(",", $values) . " WHERE ";

            foreach ($criteria as $criteria_key => $criteria_value) {
                $criteria_value = mysqli_real_escape_string($con, $criteria_value);
                $criterias[] = "" . $criteria_key . " = '" . addslashes($criteria_value) . "' ";
            }

            $begin_query .= implode(" AND ", $criterias);
            $execute = mysqli_query($con, $begin_query);

            if ($execute) {
                    return true;
            } else {
                throw new \Exception('There was an error.'.mysqli_error($con).' - ' .$begin_query);
            }


        } else {
            throw new \Exception('Mismatch between column and value count: '.count($vals).' and '. count($cols));
        }
    }
}
?>