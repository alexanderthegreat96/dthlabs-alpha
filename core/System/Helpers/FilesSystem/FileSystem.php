<?php
namespace LexSystems\Core\System\Helpers;
use LexSystems\Core\System\Helpers\CoreUtils\Utils;
use LexSystems\Framework\Config\App\Config;

class FileSystem
{
    /**
     * @return string
     */
    public static function getDiskPath():string
    {
        return realpath($_SERVER["DOCUMENT_ROOT"]).'/'.Config::STORAGE_LOCATION;
    }

    /**
     * @param string $fileName
     * @return bool
     */
    public static function checkIfFileExists(string $fileName = '',string $folder = '/', string $defaultPath = '')
    {
        if($defaultPath)
        {
            $combinedLocation = self::fixPaths($defaultPath.'/'.$folder.'/'.$fileName);
        }
        else
        {
            $combinedLocation = self::fixPaths(self::getDiskPath().'/'.$folder.'/'.$fileName);
        }

        return file_exists($combinedLocation) ? true : false;
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
     * @param string $fileName
     * @param string $contents
     * @param string $folder
     * @param string $defaultPath
     * @return array|bool
     * @throws \Exception
     */
    public static function createFile(string $fileName = '', string $contents = '',string $folder= '/', string $defaultPath = '')
    {

        $fileName = Utils::normalizeString($fileName);
        $fullPath = $defaultPath ? $defaultPath :self::getDiskPath();
        $combinedFileLocation = self::fixPaths($fullPath.'/'.$folder.'/'.$fileName);
        $combinedLocation = self::fixPaths($fullPath.'/'.$folder);

        if(self::hasDirectory($combinedLocation))
        {
            if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
            {
                $open = fopen($combinedFileLocation, 'w+');
                fwrite($open, $contents);
                if (fclose($open)) {
                    return true;
                } else {
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
                if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
                {
                    $open = fopen($combinedFileLocation, 'w+');
                    fwrite($open, $contents);
                    if (fclose($open)) {
                        return true;
                    } else {
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

    /**
     * @param string $fileName
     * @param string $tmpFile
     * @return string[]
     * @throws \Exception
     */
    public static function copyFile(string $fileName = '',string $contents = '',string $folder = '/', string $defaultPath = '')
    {
        $fileName = Utils::normalizeString($fileName);
        $fullPath = $defaultPath ? $defaultPath :self::getDiskPath();
        $combinedFileLocation = self::fixPaths($fullPath.'/'.$folder.'/'.$fileName);
        $combinedLocation = self::fixPaths($fullPath.'/'.$folder);

        if(self::hasDirectory($combinedLocation))
        {
            if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
            {
                $put = file_put_contents($combinedFileLocation,$contents);
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

                if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
                {
                    $put = file_put_contents($combinedFileLocation,$contents);
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

    /**
     * @param string $dirName
     * @param string $extraLocation
     * @return bool
     * @throws \Exception
     */
    public static function makeDir(string $dirName = '',string $extraLocation = '/')
    {
        $combinedLocation = self::fixPaths($extraLocation.'/'.$dirName);
        if(mkdir($combinedLocation, 0777, true))
        {
            return true;
        }
        else
        {
            throw new \Exception(__METHOD__.' was unable to create the directory.Permission issues most likely!');
        }

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
        else
        {
            try{
                self::makeDir($dirName);
            }
            catch(\Exception $e)
            {
                return $e->getMessage();
            }
        }
    }

    /**
     * @param string $fileName
     * @param string $folder
     * @param string $defaultPath
     * @return bool
     * @throws \Exception
     */
    public static function removeFile(string $fileName = '',string $folder = '/', string $defaultPath = '')
    {
        $fileName  = Utils::normalizeString($fileName);
        $defaultPath = $defaultPath ? $defaultPath: self::getDiskPath();
        $removePath  = self::fixPaths($defaultPath.'/'.$folder.'/'.$fileName);

        if(self::checkIfFileExists($fileName,$folder,$defaultPath))
        {
            $remove = unlink($removePath);
                if($remove)
                {
                    return true;
                }
                else
                {
                    throw new \Exception('Something went wrong when trying to delete '.$removePath);
                }
        }
        else
        {
            throw new \Exception($removePath.' does not exists or path was incorrect!');
        }
    }

    /**
     * Copy a file, or recursively copy a folder and its contents
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.0.1
     * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
     * @param       string   $source    Source path
     * @param       string   $dest      Destination path
     * @param       int      $permissions New folder creation permissions
     * @return      bool     Returns true on success, false on failure
     */
    public static function xcopy(string $source, string $dest, $permissions = 0755)
    {
        $sourceHash = self::hashDirectory($source);
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            if($sourceHash != hashDirectory($source."/".$entry)){
                xcopy("$source/$entry", "$dest/$entry", $permissions);
            }
        }

        // Clean up
        $dir->close();
        return true;
    }

    /**
     * @param string $directory
     * @return false|string
     */

    public static function hashDirectory(string $directory){
        if (! is_dir($directory)){ return false; }

        $files = array();
        $dir = dir($directory);

        while (false !== ($file = $dir->read())){
            if ($file != '.' and $file != '..') {
                if (is_dir($directory . '/' . $file)) { $files[] = hashDirectory($directory . '/' . $file); }
                else { $files[] = md5_file($directory . '/' . $file); }
            }
        }

        $dir->close();

        return md5(implode('', $files));
    }

    /**
     * @param string $dirPath
     */
    public static function removeDriectory(string $dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::removeDriectory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
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
            if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
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

                if(!self::checkIfFileExists($fileName,$folder,$defaultPath))
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