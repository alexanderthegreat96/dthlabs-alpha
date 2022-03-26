<?php
namespace LexSystems\Core\System\Extend;

use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\StorageAttributes;
use League\Flysystem\UnableToCopyFile;
use LexSystems\Framework\Config\App\Config;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
class FileSystem
{
    /**
     * @var \League\Flysystem\Filesystem
     */
    protected $filesystem;

    /**
     * @var string
     */

    protected $rootPath;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $adapter = new LocalFilesystemAdapter(
            realpath(__DIR__.'/../../../storage/'.Config::STORAGE_LOCATION),
            PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                ],
            ]),
            LOCK_EX,
            LocalFilesystemAdapter::DISALLOW_LINKS
        );
        $this->filesystem = new \League\Flysystem\Filesystem($adapter);
        $this->rootPath = realpath(__DIR__.'/../../../storage/'.Config::STORAGE_LOCATION);

    }

    /**
     * Organizez each file into its invidual directory
     */
    public function organize()
    {
        $year = date('Y');
        $month = date('m');
        $day  = date('d');

        $prependPath = $year.'/'.$month.'/'.$day;

        if(!is_dir($prependPath))
        {
            $make =  $this->createDirectory($prependPath);
               if($make['status'])
               {
                   return $make['path'];
               }
               else
               {
                   die($make['error']);
               }
        }
    }

    /**
     * @param string $path
     * @param array $config
     * @return array
     */
    public function createDirectory(string $path = '', array $config = [])
    {
        try {
            $this->filesystem->createDirectory($path, $config);
            return
                [
                    'status' => true,
                    'path' => $path
                ];
        } catch (FilesystemException | UnableToCreateDirectory $exception) {
            return
                [
                    'status' => false,
                    'error' => $exception->getMessage()
                ];
        }
    }

    /**
     * @param $contents
     * @param array $config
     * @return array|void
     */
    public function writeFile(string $filename = '',$contents,$config = [])
    {
        try {
            $this->filesystem->write($this->organize().'/'.$filename, $contents, $config);
            return ['status' => true,'filePath'  => $this->organize().'/'.$filename];
        } catch (FilesystemException | UnableToWriteFile $exception) {
            return
                [
                    'status' => false,
                    'error' => $exception->getMessage()
                ];
        }
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     * @param array $config
     * @return array|bool[]
     */
    public function copy(string $fromPath = '', string $toPath = '', array $config = [])
    {
        try{
            $this->filesystem->copy($fromPath,$toPath,$config);
            return ['status' => true];
        }
        catch (UnableToCopyFile | FilesystemException $e)
        {
            return ['status' => false,'error' => $e->getMessage()];
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
    public function copyContents(string $source = '', string $dest = '', int $permissions = 0777):bool
    {
        $source = $this->rootPath.'/'.$source;
        $dest = $this->rootPath.'/'.$dest;

        $sourceHash = $this->hashDirectory($source);
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
            if($sourceHash != $this->hashDirectory($source."/".$entry)){
                $this->copyContents("$source/$entry", "$dest/$entry", $permissions);
            }
        }

        // Clean up
        $dir->close();
        return true;
    }

    /**
     * @param string $url
     * @param string $filename
     * @param array $config
     * @return array|void
     */
    public function downloadFromUrl(string $url = '', string $filename = '',array $config = [])
    {
        $filename = $filename ? $filename:basename($url);
        $contents = file_get_contents($url);

        if($contents)
        {
            return $this->writeFile($filename,$contents,$config);
        }
        else
        {
            return ['status' => false,'error' => 'Unable to download file from location'];
        }
    }
    /**
     * @param string $directory
     * @return false|string
     */

    public function hashDirectory(string $directory = ''){
        if (! is_dir($directory)){ return false; }

        $files = array();
        $dir = dir($directory);

        while (false !== ($file = $dir->read())){
            if ($file != '.' and $file != '..') {
                if (is_dir($directory . '/' . $file)) { $files[] = $this->hashDirectory($directory . '/' . $file); }
                else { $files[] = md5_file($directory . '/' . $file); }
            }
        }

        $dir->close();

        return md5(implode('', $files));
    }

    /**
     * @param string $path
     * @return bool
     * @throws \League\Flysystem\FilesystemException
     */
    public function fileExists(string $path = '')
    {
        return $this->filesystem->fileExists($path) ? true:false;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function directoryExists(string $path = '')
    {
        return is_dir($this->rootPath.'/'.$path) ? true:false;
    }

    /**
     * @return false|string
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

//    /**
//     * @param string $path
//     * @return array
//     */
//    public function listFiles(string $path = '')
//    {
//        try{
//            $files = $this->filesystem->listContents($path)
//                ->filter(fn (StorageAttributes $attributes)=> $attributes->isFile())
//                ->toArray();
//            return ['status' => true,'files' => $files];
//        }
//        catch (FilesystemException $e)
//        {
//            return ['status' => false,'error' => $e->getMessage()];
//        }
//    }
//
//    /**
//     * @param string $path
//     * @return array
//     */
//    public function listFolders(string $path = '')
//    {
//        try{
//            $files = $this->filesystem->listContents($path)
//                ->filter(fn (StorageAttributes $attributes)=> $attributes->isDir())
//                ->toArray();
//            return ['status' => true,'files' => $files];
//        }
//        catch (FilesystemException $e)
//        {
//            return ['status' => false,'error' => $e->getMessage()];
//        }
//    }

    /**
     * @param string $path
     * @return array
     */
    public function removeFile(string $path = '')
    {
        try{
            $this->filesystem->delete($path);
            return ['status' => true,'deletedFile' => $this->rootPath.'/'.$path];
        }
        catch (FilesystemException $e)
        {
            return ['status' => false,'error' => $e->getMessage()];
        }
    }

    /**
     * @param string $path
     * @return array
     */
    public function removeDirectory(string $path = '')
    {
        try{
            $this->filesystem->deleteDirectory($path);
            return ['status' => true,'deletedDirectory' => $this->rootPath.'/'.$path];
        }
        catch (FilesystemException $e)
        {
            return ['status' => false,'error' => $e->getMessage()];
        }
    }
}
