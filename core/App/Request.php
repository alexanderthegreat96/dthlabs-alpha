<?php
namespace LexSystems\Core\App;
use LexSystems\Core\System\Extend\Upload;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Core\System\Helpers\Requests;
use LexSystems\Framework\Config\App\Config;

class Request
{
    /**
     * @var Request
     */
    private static $instance;

    /**
     * @var Requests
     */
    protected $requests;

    /**
     * @var FileSystem
     */

    protected $fileSystem;

    /**
     * @var Upload
     */

    protected $upload;

    /**
     * @return Request
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
        $this->requests = new Requests();
        $this->upload = new Upload();
    }

    /**
     * @param string $key
     * @return bool|void
     */
    public static function hasArgument(string $key = '')
    {
        return self::App()->requests->hasArgument($key);
    }

    /**
     * @param string $key
     * @return false|mixed|void
     */
    public static function getArgument(string $key = '')
    {
        return self::App()->requests->getArgument($key);
    }

    /**
     * @return array
     */
    public static function getArguments()
    {
        return self::App()->requests->getArguments();
    }

    /**
     * @return array|string|string[]
     */
    public static function getCurrentUrl()
    {
        return self::App()->requests->getCurrentUrl();
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function hasFile(string $key = '')
    {
        return self::App()->requests->hasFile($key);
    }

    /**
     * @param string $key
     * @return array|null
     */
    public static function getFile(string $key = '')
    {
        return self::App()->requests->getFile($key);
    }

    /**
     * @return bool
     */
    public static function hasFiles()
    {
        return self::App()->requests->hasFiles();
    }

    /**
     * @param string $key
     * @return array|mixed|string|void|null
     */

    public static function get(string $key  =  '')
    {
        return self::App()->requests::_GP($key);
    }

    /**
     * @param string $location
     */
    public static function redirect(string $location = '')
    {
        return self::App()->requests->redirect($location);
    }

    /**
     * @return array
     */
    public static function getFiles()
    {
        return self::App()->requests->getFiles();
    }

    /**
     * @param string $key
     * @param string $filename
     * @return array|void
     */
    public static function uploadFile(string $key = '', string $filename = '')
    {
        if(self::hasFile($key))
        {
            return self::App()->upload->upload($key,$filename);
        }
    }

    /**
     * @param string $inputKey
     * @param bool $randomName
     * @return array|void
     */
    public static function bulkUpload(string $inputKey = '', bool $randomName = true)
    {
        if(self::hasFile($inputKey))
        {
            return self::App()->upload->bulkUpload($inputKey);
        }
    }
}