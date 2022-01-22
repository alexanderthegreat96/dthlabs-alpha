<?php
namespace LexSystems\Framework\Core\Boot;
use LexSystems\Core\System\Helpers\Database\MySqli;

class PackageManager
{
    /**
     * @var string
     */
    protected $packageLocation;
    protected $configs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->packageLocation = __DIR__ . '/../Packages';
        $this->configs = self::loadConfigFilesAndClasses($this->packageLocation);
        $this->mysqli = new MySqli();
    }

    public function getConfigs():array
    {
        return $this->configs;
    }

    /**
     * @param string $directory
     * @param array $result
     * @return array
     * Loads configurations and classes for the package
     */

    public static function loadConfigFilesAndClasses(string $directory = '', array &$result = []) {
        if(is_dir($directory)) {
            $scan = scandir($directory);
            unset($scan[0], $scan[1]); //unset . and ..
            foreach($scan as $file) {
                if(is_dir($directory."/".$file)) {
                    self::loadConfigFilesAndClasses($directory."/".$file,$result);
                } else {
                    if($file == 'module_config.php') {
                        $result[basename($directory)]['config'] = [];
                        $path = new \SplFileInfo($directory . '/' . $file);
                        $path = $path->getRealPath();
                        $contents = include $path;
                        if (is_array($contents)) {
                            $contents = json_encode($contents);
                            $contents = json_decode($contents, true);
                            $result[basename($directory)]['config'] = $contents;
                        }
                    }
                    elseif($file == 'module_status') {
                        $result[basename($directory)]['status'] = [];
                        $status = file_get_contents($directory.'/'.$file);
                        if($status == 'INSTALLED')
                        {
                            $installed = true;
                        }
                        else
                        {
                            $installed = false;
                        }
                        $result[basename($directory)]['status'] = $installed;
                    }
                }
            }
        }
        if($result)
        {
            return array_filter($result);
        }
    }

    /**
     * @param string $ext_key
     * @return bool
     * @throws \Exception
     */

    private function install(string $ext_key = '')
    {
        $sqlFile = $this->packageLocation.'/'.$ext_key.'/module_tables.sql';
        $extLocation = $this->packageLocation.'/'.$ext_key;
        if(file_exists($sqlFile))
        {
            $con = $this->mysqli->connect();
            $query = file_get_contents($sqlFile);
            $insert = mysqli_multi_query($con, $query);

            if($insert)
            {
                $fp = fopen($extLocation.'/module_status','W');
                if(file_put_contents($extLocation.'/module_status','INSTALLED'))
                {
                    return true;
                }
                else
                {
                    throw new Exception('Insufficient permissions to write file to '.$extLocation.'/module_status');
                }
            }
            else
            {
                throw new Exception(mysqli_error($con));
            }
        }
        else
        {
            throw new Exception('No module_sql file found in: '.$extLocation);
        }
    }

    /**
     * @return array[]
     */
    public function boot()
    {
        $loaded = [];
        $modules = self::loadConfigFilesAndClasses($this->packageLocation);
        if($modules)
        {
            $loadedClasses = [];
            foreach($modules as $module_key=>$value)
            {
                if(isset($modules[$module_key]['config']))
                {
                    if (isset($modules[$module_key]['config']['classMap'])) {
                        $classLocation = $this->packageLocation .'/'.$module_key. '/Classes/';
                        if (is_dir($classLocation)) {
                            foreach ($modules[$module_key]['config']['classMap'] as $className) {
                                if (file_exists($classLocation . $className)) {
                                    array_push($loadedClasses,['location' => $classLocation,'name' => $className]);
                                    require($classLocation . $className);
                                }
                            }
                        }
                    }
                    if (isset($modules[$module_key]['status'])) {
                        if(!$modules[$module_key]['status'])
                        {
                            $this->install($module_key);
                        }
                    }

                    array_push($loaded,[
                        $module_key =>
                        [
                            'name' => $modules[$module_key]['config']['name'],
                            'author' => $modules[$module_key]['config']['author'],
                            'version' => $modules[$module_key]['config']['version'],
                            'title' => $modules[$module_key]['config']['title'],
                            'is_installed' => $modules[$module_key]['status'],
                            'loaded-classes' => $loadedClasses
                        ]]);
                }

            }
        }

        return $loaded;

    }
}