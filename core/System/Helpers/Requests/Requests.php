<?php
namespace LexSystems\Framework\Kernel\Helpers;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;
use LexSystems\Framework\Kernel\Helpers\Arrays\ArrayUtility;

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

    public function hasArgument(string $param = '',string $type = 'GET')
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


    public function getArgument( string $param = '',string $type = 'GET')
    {
        if($this->hasArgument($param,$type))
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

    /**
     * @param $var
     * @return mixed|string|void|null
     */
    public static function _GP($var)
    {
        if (empty($var)) {
            return;
        }
        if (isset($_POST[$var])) {
            $value = $_POST[$var];
        } elseif (isset($_GET[$var])) {
            $value = $_GET[$var];
        } else {
            $value = null;
        }
        // This is there for backwards-compatibility, in order to avoid NULL
        if (isset($value) && !is_array($value)) {
            $value = (string)$value;
        }
        return $value;
    }


    /**
     * Code bellow belongs to Typo3 Project
     * Returns the global arrays $_GET and $_POST merged with $_POST taking precedence.
     *
     * @param string $parameter Key (variable name) from GET or POST vars
     * @return array Returns the GET vars merged recursively onto the POST vars.
     */
    public static function _GPmerged($parameter)
    {
        $postParameter = isset($_POST[$parameter]) && is_array($_POST[$parameter]) ? $_POST[$parameter] : [];
        $getParameter = isset($_GET[$parameter]) && is_array($_GET[$parameter]) ? $_GET[$parameter] : [];
        $mergedParameters = $getParameter;
        ArrayUtility::mergeRecursiveWithOverrule($mergedParameters, $postParameter);
        return $mergedParameters;
    }

    /**
     * Returns the global $_GET array (or value from) normalized to contain un-escaped values.
     * This function was previously used to normalize between magic quotes logic, which was removed from PHP 5.5
     *
     * @param string $var Optional pointer to value in GET array (basically name of GET var)
     * @return mixed If $var is set it returns the value of $_GET[$var]. If $var is NULL (default), returns $_GET itself.
     * @see _POST()
     * @see _GP()
     */
    public static function _GET($var = null)
    {
        $value = $var === null
            ? $_GET
            : (empty($var) ? null : ($_GET[$var] ?? null));
        // This is there for backwards-compatibility, in order to avoid NULL
        if (isset($value) && !is_array($value)) {
            $value = (string)$value;
        }
        return $value;
    }

    /**
     * Returns the global $_POST array (or value from) normalized to contain un-escaped values.
     *
     * @param string $var Optional pointer to value in POST array (basically name of POST var)
     * @return mixed If $var is set it returns the value of $_POST[$var]. If $var is NULL (default), returns $_POST itself.
     * @see _GET()
     * @see _GP()
     */
    public static function _POST($var = null)
    {
        $value = $var === null ? $_POST : (empty($var) || !isset($_POST[$var]) ? null : $_POST[$var]);
        // This is there for backwards-compatibility, in order to avoid NULL
        if (isset($value) && !is_array($value)) {
            $value = (string)$value;
        }
        return $value;
    }
}
