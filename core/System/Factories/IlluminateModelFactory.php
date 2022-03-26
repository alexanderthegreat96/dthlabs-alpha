<?php
namespace LexSystems\Core\System\Factories;
class IlluminateModelFactory extends AbstractModelFactory
{
    /**
     * @param string $className
     * @param string $tablename
     * @param array $fillable
     * @return string
     */
    public function writeClass(string $className,string $tablename = '', array $fillable = [])
    {
        $fillable = $fillable ? $this->generateFillableFromArray($fillable) : '[]';
        $template =
'<?php
namespace App\Models;
use Core\Model;
class '.$className.' extends Model
{
    protected $table = "'.$tablename.'";
    protected $fillable = '.$fillable.';
}
?>';
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
         * Get table names firsst
         */
        $tableNames = $this->getTableNames();
        if($tableNames)
        {
            print("Illuminate Model Factory has been started...\r");
            $i = 1;
            foreach ($tableNames as $tableName)
            {
                $className = $this->convertTableName($tableName);
                $columns = $this->showTableColums($tableName);
                print ($i.'.'.$this->writeClass($className,$tableName,$columns) ."\n");

                $i++;
            }
        }
        else
        {
            print("No tables found in the database\n");
        }
    }
}