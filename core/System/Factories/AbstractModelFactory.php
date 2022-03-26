<?php
namespace LexSystems\Core\System\Factories;

use LexSystems\Framework\Config\Database\MysqlConfig as Config;

class AbstractModelFactory
{
    /**
     * IlluminateModelFactory constructor
     */
    public function __construct()
    {
        $connection = new \LexSystems\Core\System\Helpers\Database\MySqli();
        $this->connection  = $connection->connect();
    }
    /**
     * @param array $tables
     * @return array
     */
    public function getTableNames(array &$tables = [])
    {
        $query = mysqli_query($this->connection,'show tables;');
        if($query)
        {
            while($a = mysqli_fetch_assoc($query))
            {
                $tables[] = $a['Tables_in_'.Config::MYSQL_DB];
            }
        }

        return $tables;
    }

    /**
     * @param string $tablename
     * @return array|false|string[]|void|null
     */
    public function showTableColums(string $tablename = '',bool $justNames = true, array &$columns = [])
    {
        $query = mysqli_query($this->connection, 'SHOW COLUMNS FROM '.$tablename.';');
        if($query)
        {
            while($a = mysqli_fetch_assoc($query))
            {
                if($justNames)
                {
                    $columns[] = $a['Field'];
                }
                else
                {
                    $columns[] = ['name' => $a['Field'],'type' => $a['Type']];
                }
            }
        }

        return $columns;
    }

    /**
     * @param string $tablename
     * @return string
     */
    public function convertTableName(string $tablename = '')
    {
        $names = explode("_",$tablename);
        if($names)
        {
            foreach($names as $name)
            {
                $renamed[] = ucfirst($name);
            }

            return implode("",$renamed);
        }
        else
        {
            return $tablename;
        }
    }

    /**
     * @param string $colname
     * @return string
     */
    public function convertColName(string $colname = '')
    {
        $names = explode("_",$colname);
        if($names)
        {
            foreach($names as $name)
            {
                $renamed[] = ucfirst($name);
            }

            return lcfirst(implode("",$renamed));
        }
        else
        {
            return $colname;
        }
    }

    /**
     * @param array $fillables
     * @return string|void
     */
    public function generateFillableFromArray(array $fillables = [])
    {
        if($fillables)
        {
            foreach($fillables as $fillable)
            {
                $text[] = '"'.$fillable.'"';
            }

            $text = implode(',',$text);
            $text  = '['.$text.']';
            return $text;
        }
    }
}