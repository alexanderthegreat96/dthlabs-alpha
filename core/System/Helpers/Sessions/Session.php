<?php
namespace LexSystems\Core\System\Helpers\Sesssions;
use Core\Debugger;
use LexSystems\Core\System\Helpers\CoreUtils\RandomStringGenerator;
use LexSystems\Framework\Config\App\Config;
class Session
{
    /**
     * @var
     */
    protected $prefix;

    /**
     * @var
     */

    protected $session;

    /**
     * @var
     */

    protected $cookie;


    /**
     * @param string $prefix
     */
    public function __construct(string $prefix = '')
    {
        /**
         * Init session
         */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /**
         * Predefined session key
         * Predefined cookie key
         * supporting multi-domain instances
         * on the same host
         */

        $this->prefix = $prefix ? $prefix : Config::APP_KEY;

        /**
         * Generate a session id
         */

        if(!isset($_SESSION[$this->prefix]['session_id']))
        {
            $rand = new RandomStringGenerator();
            $_SESSION[$this->prefix]['session_id'] = $rand->generate(15);
        }

        $this->cookie = $_COOKIE;
        $this->session = $_SESSION[$this->prefix];
    }

    /**
     * @return array
     */

    public function initSession()
    {
        return $this->getSession();
    }

    /**
     * @param string $key
     * @param string $values
     * lasts for 1 day
     */
    public function setCookie(string $key = '', string $hash = ''):string
    {
        setcookie($this->prefix.'/'.$key, $hash, time() + (86400 * 30), "/"); // 86400 = 1 day
        return $hash;
    }

    /**
     * @param string $key
     */
    public function unsetCookie(string $key = ''):void
    {
        if($this->hasCookie($key))
        {
            unset($_COOKIE[$key]);
        }
        return;
    }

    /**
     * @return array|bool
     */
    public function getCookies():array
    {
        return isset($_COOKIE) ? $_COOKIE : [];
    }
    /**
     * @param string $key
     * @return bool
     */
    public function hasCookie(string $key = '')
    {
        return isset($_COOKIE[$key]) ? true:false;
    }


    public function hasCookies()
    {
        return isset($_COOKIE) ? true:false;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getCookie(string $key = '')
    {
        return $this->hasCookie($key) ? $_COOKIE[$key]:null;
    }

    /**
     * @param array $array
     * @param array $result
     * Maps any array structure and
     * sends it to session
     * ['name' => 'Aleaxander', 'is_logged_in' => 'True]
     */
    public function sendTheseToSession(array $array = [], array &$result = [])
    {
        if($array)
        {
            foreach($array as $key=>$value)
            {
                $this->setSession($key,$value);
                $result[$key] = [$key => $value];
            }
            return $result;
        }
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param string|array $param
     */
    public function unsetSession($param)
    {
        if(isset($this->session[$param]))
        {
            unset($_SESSION[$this->prefix][$param]);
        }
    }

    /**
     * @param string|array $param
     * @return mixed|null
     */

    public function getParam($param = '')
    {
        return isset($this->session[$param]) ? $this->session[$param]:null;
    }

    /**
     * @param string|array $param
     * @return bool
     */
    public function hasParam($param = '')
    {
        return isset($this->session[$param]) ? true:false;
    }

    /**
     * @param string|array $param
     * @param $value
     * @return mixed
     */

    public function setSession($param,$value)
    {
        if(isset($this->session[$param]))
        {
            $this->unsetSession($param);
            return $_SESSION[$this->prefix][$param] = $value;
        }
        else
        {
            return $_SESSION[$this->prefix][$param] = $value;
        }

    }

    /**
     * @param string $key
     * @return string
     */
    protected function cookieParam(string $key = '')
    {
        return basename($key);
    }
    /**
     * @return bool
     */
    public function destroy()
    {
        if(isset($this->session))
        {
            foreach($this->session as $key=>$value)
            {
                $this->unsetSession($key);
            }
        }

        if(isset($this->cookie))
        {
            foreach ($this->cookie as $key=>$value)
            {
                $this->unsetCookie($key);
            }
        }

        return true;
    }

}