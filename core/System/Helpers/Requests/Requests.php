<?php
namespace LexSystems\Core\System\Helpers;
use LexSystems\Core\System\Helpers\Arrays\ArrayUtility;
use LexSystems\Core\System\Helpers\Sesssions\Session;

class Requests
{
    /**
     * Requests constructor.
     */
    public function __construct()
    {
        $this->server = $_SERVER;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->port = $_SERVER['SERVER_PORT'];
        $this->session = $_SESSION;
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
     * @param string $input_name
     * @return false|mixed|string|void
     */
    public function getFormValue(string $input_name = '')
    {
        return $this->hasArgument($input_name) ? $this->getArgument($input_name) : '';
    }

    public function getFormInputs()
    {
        return array_filter($this->getArguments());
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
                return isset($this->get[$param]) ? true:false;
                break;
            case 'POST':
                return isset($this->post[$param]) ? true:false;
                break;
            default:
                return false;
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
                    break;
            }
        }
        else
        {
            return false;
        }
    }


    /**
     * @return array
     */

    public function getArguments()
    {
        $result=[];
        $result['post'] = $this->post;
        $result['get'] = $this->get;
        $result['files'] = $this->hasFiles() ? $this->remapSFilesArray():null;
        $result['session'] = $this->session;
        $result['cookie'] = isset($_COOKIE) ? $_COOKIE : null;
        $result['server'] = $_SERVER;
        $result['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $result['client_ip']  = $_SERVER['REMOTE_ADDR'];
        $result['headers'] = getallheaders();
        return $result;
    }





    /**
     * @return bool
     */
    public function hasFiles():bool
    {
        return isset($_FILES) ? true:false;
    }

    /**
     * @return array
     */
    public function getFiles():array
    {
        return $this->hasFiles() ? $this->remapSFilesArray():[];
    }

    /**
     * @param array $return
     * @return array
     */

    protected function remapSFilesArray(array &$return = []):array
    {
        if($this->hasFiles())
        {
            foreach ($_FILES as $key=>$value)
            {
                $return[$key] = $this->simplifyMultiFileArray($value);
            }
        }

        return $return;
    }

    /**
     * @param array $files
     * @return array
     */
    protected function simplifyMultiFileArray(array $files = [])
    {
        $sFiles = array();
        if(is_array($files) && count($files) > 0)
        {
            foreach($files as $key => $file)
            {
                foreach($file as $index => $attr)
                {
                    $sFiles[$index][$key] = $attr;
                }
            }
        }
        return $sFiles;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasFile(string $key)
    {
        return isset($_FILES[$key]) ? true:false;
    }

    /**
     * @param string $key
     * @return array|null
     */
    public function getFile(string $key)
    {
        return $this->hasFile($key) ? $this->simplifyMultiFileArray($_FILES[$key]):null;
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

    /**
     * @param string $url
     */

    public function redirect(string $url = '')
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
        } else {
            $content = '<script type="text/javascript">';
            $content .= 'window.location.href="' . $url . '";';
            $content .= '</script>';
            $content .= '<noscript>';
            $content .= '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            $content .= '</noscript>';
            echo $content;
        }
    }
}
