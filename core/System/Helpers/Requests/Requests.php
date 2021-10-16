<?php
namespace LexSystems\Framework\Kernel\Helpers;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;

class Requests
{
    public function __construct()
    {
        $this->server = $_SERVER;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->port = $_SERVER['SERVER_PORT'];
    }

    /**
     * Map Request to session
     */

    public function mapCurrentRequest()
    {
        $session = new Session();
        $session->unsetSession('last_known_location');
        $session->setSession('last_known_location',$this->getCurrentUrl());
        return $this->getCurrentUrl();
    }

    /**
     * @param bool $withQuery
     * @return array|string|string[]
     */
    public function getCurrentUrl($withQuery = true)
    {

        switch ($this->port)
        {
            case '80':
                $protocol = 'http';
                break;
            case '443':
                $protocol = 'https';

            default:
                $protocol = 'http';
        }

        $uri = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return $withQuery ? $uri : str_replace('?' . $_SERVER['QUERY_STRING'], '', $uri);
    }
    /**
     * @param string $type
     * @param string $param
     * @return bool|void
     */

    public function hasRequest(string $type = 'GET', string $param = '')
    {
        switch ($type)
        {
            case 'GET':
                if(isset($this->get[$param]))
                {
                    return true;
                }
                else
                {
                    return false;
                }
                break;
            case 'POST':
                if(isset($this->post[$param]))
                {
                    return true;
                }
                else
                {
                    return false;
                }
                break;
        }
    }

    /**
     * @param string $type
     * @param string $param
     * @return mixed|void
     */


    public function getRequest(string $type = 'GET', string $param = '')
    {
        if($this->hasRequest($type,$param))
        {
            switch ($type)
            {
                case 'GET':
                    return $this->get[$param];
                    break;
                case 'POST':
                    return $this->post[$param];
            }
        }
        else
        {
            return false;
        }
    }
}