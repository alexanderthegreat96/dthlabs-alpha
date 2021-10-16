<?php
namespace LexSystems\Framework\Kernel\Helpers\Sesssions;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\RandomStringGenerator;
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
                if(is_array($value))
                {
                    self::sendTheseToSession($value);
                }
                else
                {
                    $this->setSession($key,$value);
                    $result[] = [$key => $value];
                }
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
     * @return mixed
     */

    public function setSession(string $param,string $value)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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

    public function session_destroy()
    {
        return session_destroy();
    }

}