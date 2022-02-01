<?php
namespace LexSystems\Core\System\Helpers\Sesssions;
use LexSystems\Core\System\Helpers\CoreUtils\RandomStringGenerator;

class Session
{
    public function __construct()
    {
        /**
         * Init session
         */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /**
         * Generate a session id
         */
        if(!isset($_SESSION['session_id']))
        {
            $rand = new RandomStringGenerator();
            $_SESSION['session_id'] = $rand->generate(15);
        }
    }

    /**
     * @return array
     */

    public function initSession()
    {
        return $this->getSession();
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
        return $_SESSION;
    }

    /**
     * @param string $param
     */
    public function unsetSession(string $param)
    {
        if(isset($_SESSION[$param]))
        {
            unset($_SESSION[$param]);
        }
    }

    /**
     * @param string $param
     * @return mixed|string
     */

    public function getParam(string $param = '')
    {
        return isset($_SESSION[$param]) ? $_SESSION[$param]:null;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function hasParam(string $param = '')
    {
        return isset($_SESSION[$param]) ? true:false;
    }

    /**
     * @param string $param
     * @return mixed
     */

    public function setSession(string $param,$value)
    {
        if(isset($_SESSION[$param]))
        {
            $this->unsetSession($param);
            return $_SESSION[$param] = $value;
        }
        else
        {
            return $_SESSION[$param] = $value;
        }

    }
    /**
     * @param string $key
     * @param string $values
     * lasts for 1 day
     */
    public function setCookie(string $key = ''):void
    {
        /**
         * cookie name + ip  = hash
         */
        $hash = md5(sha1($_SERVER['REMOTE_ADD'].'_'.$key));
        setcookie($key, $hash, time() + (86400 * 30), "/"); // 86400 = 1 day
        return ;
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

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getCookie(string $key = '')
    {
        return $this->hasCookie($key) ? $_COOKIE[$key]:null;
    }

    /**
     * @return bool
     */
    public function session_destroy()
    {
        return session_destroy();
    }

}