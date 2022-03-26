<?php
namespace LexSystems\Core\App;
use LexSystems\Core\System\Extend\FileSystem as FileSystemAlias;

class FileSystem
{
    /**
     * @var FileSystem
     */
    private static $instance;

    /**
     * @var FileSystemAlias
     */
    protected $filesystem;

    /**
     * @return FileSystem
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
        $this->filesystem = new FileSystemAlias();
    }

    /**
     * @return string
     */
    public static function getStoragePath():string
    {
        return self::App()->filesystem->getRootPath();
    }


    /**
     * @param string $path
     * @param array $config
     * @return array
     */
    public static function createDirectory(string $path = '', array $config = [])
    {
        return self::App()->filesystem->createDirectory($path,$config);
    }

    /**
     * @param string $filename
     * @param $contents
     * @param array $config
     * @return array|void
     */
    public static function writeFile(string $filename = '', $contents, array $config = [])
    {
        return self::App()->filesystem->writeFile($filename,$contents,$config);
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     * @param array $config
     * @return array|bool[]
     */
    public static function copyFile(string $fromPath = '', string $toPath = '', array $config = [])
    {
        return self::App()->filesystem->copy($fromPath,$toPath,$config);
    }

    /**
     * @param string $fromPath
     * @param string $toPath
     * @param int $permissions
     * @return bool
     */
    public static function copyContents($fromPath = '', string $toPath = '', int $permissions = 0777)
    {
        return self::App()->filesystem->copyContents($fromPath,$toPath,$permissions);
    }

    /**
     * @param string $url
     * @param string $filename
     * @param array $config
     * @return array|void
     */
    public static function downloadFromUrl(string $url  = '', string $filename = '', array $config = [])
    {
        return self::App()->filesystem->downloadFromUrl($url,$filename,$config);
    }

    /**
     * @param string $path
     * @return false|string
     */
    public static function hashDirectory(string $path = '')
    {
        return self::App()->filesystem->hashDirectory($path);
    }

    /**
     * @param string $path
     * @return bool
     * @throws \League\Flysystem\FilesystemException
     */
    public static function fileExists(string $path = '')
    {
        return self::App()->filesystem->fileExists($path);
    }

    /**
     * @param string $path
     * @return bool
     */
    public static function directoryExists(string $path = '')
    {
        return self::App()->filesystem->directoryExists($path);
    }

    /**
     * @param string $path
     * @return array
     */
    public static function removeFile(string $path = '')
    {
        return self::App()->filesystem->removeFile($path);
    }

    /**
     * @param string $path
     * @return array
     */
    public static function removeDirectory(string $path = '')
    {
        return self::App()->filesystem->removeDirectory($path);
    }

    /**
     * @param string $path
     * @return array
     */
    public static function listFiles(string $path = '')
    {
        return self::App()->filesystem->listFiles($path);
    }

    /**
     * @param string $path
     * @return array
     */
    public static function listFolders(string $path = '')
    {
        return self::App()->filesystem->listFolders($path);
    }
}