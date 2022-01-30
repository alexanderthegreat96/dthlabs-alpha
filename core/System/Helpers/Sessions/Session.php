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
     * @return bool
     */
    public function session_destroy()
    {
        return session_destroy();
    }

}