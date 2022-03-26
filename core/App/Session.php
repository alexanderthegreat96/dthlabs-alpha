<?php
namespace LexSystems\Core\App;

class Session
{
    /**
     * @var Session
     */
    private static $instance;

    /**
     * @var \LexSystems\Core\System\Helpers\Sesssions\Session
     */
    protected $session;



    /**
     * @return Session
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
        $this->session = new \LexSystems\Core\System\Helpers\Sesssions\Session();
    }

    /**
     * @return array
     */
    public static function getSession()
    {
        return self::App()->session->getSession();
    }

    /**
     * @param string $param
     * @return bool
     */
    public static function hasParam(string $param = '')
    {
        return self::App()->session->hasParam($param);
    }

    /**
     * @param string $param
     * @return mixed|string|null
     */
    public static function getParam(string $param = '')
    {
        return self::App()->session->getParam($param);
    }

    /**
     * @param string $param
     * @return bool
     */
    public static function hasCookie(string $param = '')
    {
        return self::App()->session->hasCookie($param);
    }

    /**
     * @param string $param
     * @return mixed|null
     */
    public static function getCookie(string $param = '')
    {
        return self::App()->session->getCookie($param);
    }

    /**
     * @return array|bool
     */
    public static function getCookies()
    {
        return self::App()->session->getCookies();
    }

    /**
     * @param string $key
     */
    public static function setCookie(string $key = '')
    {
        return self::App()->session->setCookie($key);
    }

    /**
     * @param string $key
     */
    public static function unsetCookie(string $key = '')
    {
        return self::App()->session->unsetCookie($key);
    }

    /**
     * @return bool
     */
    public static function destroy()
    {
        return self::App()->session->session_destroy();
    }
}