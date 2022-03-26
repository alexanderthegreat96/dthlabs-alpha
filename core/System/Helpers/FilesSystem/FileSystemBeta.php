<?php
namespace LexSystems\Core\System\Helpers;

use LexSystems\Framework\Config\App\Config;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class FileSystemBeta
{
    /**
     * @var FileSystemBeta
     */
    private static $instance;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @return FileSystemBeta
     */
    private static function App()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->rootPath = realpath($_SERVER['DOCUMENT_ROOT']);
        $this->defaultPath = Config::STORAGE_LOCATION;
    }

    /**
     * @param string $path
     * @return string|null
     */
    public static function fixPaths(string $path = '')
    {
        if($path)
        {
            $paths = explode('/',$path);
            $paths = array_filter($paths);
            $paths = implode('/',$paths);
            return '/'.$paths;
        }
        else
        {
            return $path;
        }
    }

    /**
     * @param string $name
     * @param string $additionalPath
     * @param int $perms
     */
    public static function createDirectory(string $name = '', string $additionalPath = '',int $perms = 0777)
    {
        $fullPath = self::fixPaths(self::App()->rootPath.'/'.self::App()->defaultPath.'/'.$additionalPath.'/'.$name);
        return self::App()->filesystem->mkdir($fullPath);
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     * @param bool $useDefaultPath
     */

    public static function copyFile(string $fromPath = '', string $toPath = '', bool $useDefaultPath = true)
    {
        $toPath = $useDefaultPath ? self::fixPaths(self::App()->rootPath.'/'.self::App()->defaultPath.'/'.$toPath) : $toPath;
        return self::App()->filesystem->copy($fromPath,$toPath);
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     * @param bool $useDefaultPath
     */

    public static function copyFolder(string $fromPath = '', string $toPath = '', bool $useDefaultPath = true)
    {
        $toPath = $useDefaultPath ? self::fixPaths(self::App()->rootPath.'/'.self::App()->defaultPath.'/'.$toPath) : $toPath;
        return self::App()->filesystem->mirror($fromPath,$toPath);
    }

    /**
     * @param string $filePath
     * @param string $content
     */
    public static function appendToFile(string $filePath = '', string $content = '')
    {
        return self::App()->filesystem->appendToFile($filePath,$content);
    }

    /**
     * @param iterable|string $files
     */
    public static function remove($files)
    {
        return self::App()->filesystem->remove($files);
    }

    public static function getDiskPath():string
    {
        return realpath($_SERVER["DOCUMENT_ROOT"]).'/'.Config::STORAGE_LOCATION;
    }

    /**
     * @param $folder
     * @return false|string
     */
    public static function folder_exist($folder)
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);
        // If it exist, check if it's a directory
        return ($path !== false AND is_dir($path)) ? $path : false;
    }

    /**
     * @param string $dirName
     * @return bool
     * @throws \Exception
     */
    public static function hasDirectory(string $dirName = '')
    {
        if(self::folder_exist(self::fixPaths($dirName)))
        {
            return true;
        }
        else {
            return self::createDirectory($dirName);
        }
    }

    /**
     * @param string $path
     * @return bool
     */
    public static function checkIfFileExists(string $path = '')
    {
        return file_exists($path) ? true:false;
    }
    /**
     * @param string $fileUrl
     * @param string $folder
     * @param string $defaultPath
     * @return array
     * @throws \Exception
     */
    public static function downloadFile(string $fileUrl = '',string $folder = '/', string $defaultPath = '')
    {
        $fileName = basename($fileUrl);
        $fullPath = $defaultPath ? $defaultPath :self::getDiskPath();
        $combinedFileLocation = self::fixPaths($fullPath.'/'.$folder.'/'.$fileName);
        $combinedLocation = self::fixPaths($fullPath.'/'.$folder);

        if(self::hasDirectory($combinedLocation))
        {
            if(!self::checkIfFileExists($combinedFileLocation))
            {
                $put = file_put_contents($combinedFileLocation,file_get_contents($fileUrl));
                if($put)
                {
                    return
                        [
                            'location' => $combinedLocation,
                            'fileName' => $fileName,
                            'size' => filesize($combinedFileLocation)
                        ];
                }
                else
                {
                    throw new \Exception(__METHOD__.' could not be executed. 
           There was an error related to the location or permission issues for: '.$combinedFileLocation);
                }
            }
            else
            {
                throw new \Exception($fileName.' already exists in: '.$combinedLocation);
            }
        }
        else
        {
            try{
                self::makeDir($combinedLocation);

                if(!self::checkIfFileExists($combinedFileLocation))
                {
                    $put = file_put_contents($combinedFileLocation,file_get_contents($fileUrl));
                    if($put)
                    {
                        return
                            [
                                'location' => $combinedLocation,
                                'fileName' => $fileName,
                                'size' => filesize($combinedFileLocation)
                            ];
                    }
                    else
                    {
                        throw new \Exception(__METHOD__.' could not be executed. 
           There was an error related to the location or permission issues for: '.$combinedFileLocation);
                    }
                }
                else
                {
                    throw new \Exception($fileName.' already exists in: '.$combinedLocation);
                }
            }

            catch (\Exception $e)
            {
                return ['status' => false,'error' => $e->getMessage()];
            }

        }


    }

}