<?php
namespace LexSystems\Core\System\Factories;
class DoctrineModelFactory extends AbstractModelFactory
{
    /**
     * @param string $className
     * @param string $tablename
     * @param array $columns
     * @return string
     */
    private function writeClass(string $className = '',string $tablename = '', array $columns = [], array $columnNames = [])
    {
        $template =
            '<?php
namespace App\Models;
use Model;
class '.$className.' extends Model
{
';
        foreach ($columns as $column)
        {
$template .= '
    /**
     * @var
    */
    protected $'.$this->convertColName($column['name']).';   
';
        }
        foreach($columnNames as $columnName)
        {
            $columnVars[] = '$'.$this->convertColName($columnName);
        }
        $columnVars = implode(',',$columnVars);

$template .='
    public function __construct('.$columnVars.')
    {';
foreach($columnNames as $columnName)
{
    $template .='
        $this->set'.$this->convertTableName($columnName).'($'.$this->convertColName($columnName).');';
}
$template .= '
    }';
        foreach ($columns as $column)
        {
            if(strpos($column['type'],'int') !== false)
            {
                $template  .= '
    /**
    * @param int $'.$this->convertColName($column['name']).' 
    * @return void
    */
    public function set'.$this->convertTableName($column['name']).'(int $'.$this->convertColName($column['name']).' = 0):void
    {
        $this->'.$this->convertColName($column['name']).' = $'.$this->convertColName($column['name']).';
    }
    
    /** 
    * @return int
    */
    public function get'.$this->convertTableName($column['name']).'():int
    {
        return $this->'.$this->convertColName($column['name']).';
    }
';
            }
            else
            {
                $template  .= ' 
    /**
    * @param string $'.$this->convertColName($column['name']).' 
    * @return void
    */
    public function set'.$this->convertTableName($column['name']).'(string $'.$this->convertColName($column['name']).' = ""):void
    {
        $this->'.$this->convertColName($column['name']).' = $'.$this->convertColName($column['name']).';
    }
    
    /** 
    * @return string
    */
    public function get'.$this->convertTableName($column['name']).'():string
    {
        return $this->'.$this->convertColName($column['name']).';
    }
';
            }
        }
$template.= '
}
?>
';
        if(!file_exists(__DIR__.'/../../../app/Models/'.$className.'.php'))
        {
            $try = file_put_contents(__DIR__.'/../../../app/Models/'.$className.'.php',$template);
            if($try)
            {
                return $className . " has been created in app/Models \n";
            }
            else
            {
                return $className . " could not be written, permission issues are most likely the cause!\n";
            }
        }
        else
        {
            return $className . " skipped, as it already exists.!\n";
        }

    }

    /**
     * Build models
     */
    public function build()
    {
        /**
         * Get table names first
         */
        $tableNames = $this->getTableNames();
        if($tableNames)
        {
            print("Doctrine Model Factory has been started...\r");
            $i = 1;
            foreach ($tableNames as $tableName)
            {
                $className = $this->convertTableName($tableName);
                $columns = $this->showTableColums($tableName,false);
                $columnNames = $this->showTableColums($tableName);
                print ($i.'.'.$this->writeClass($className,$tableName,$columns,$columnNames) ."\n");
                $i++;
            }
        }
        else
        {
            print("No tables found in the database\n");
        }
    }
}