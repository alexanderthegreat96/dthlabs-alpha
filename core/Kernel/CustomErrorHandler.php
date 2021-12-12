<?php

/*
	ErrorHandler Class
	By James King
	v0.1 Alpha
	WARNING: This class is still in ALPHA phase. Not recommended for production.

	Manages and handles any PHP errors found in your script.

	Features
	- Debug configuration to show full error contents or a pretty message.
	- Mute configuration to completely mute all errors.
	- Technical Email configuration to have emails sent out upon error.
	- Error Level configuration for error levels of when to email the technical email.
	- Editable friendly message to show if mute is off and debug is off.
	Future Features
	(none yet)
*/

/**
 * ErrorHandler Class - Manages and Handles all PHP errors.
 */
class ErrorHandler
{
    private $debug = false; // Debug mode. True to show full PHP error, false to show prettier error text.
    private $mute = false; // Set to true to hide all errors, false for default error class action.
    private $technicalEmail; // Technical email to send all errors to. (Blank/false/NULL for don't send errors)
    public $friendlyMsg = "Sorry, an error has occured. Please contact your system administrator."; // Friendly HTML error message shown if debug is off and mute is off. Override this manually.
    public $sendEmail = array(E_ERROR, E_USER_ERROR, E_USER_WARNING, E_WARNING); // Array of error levels which require an email to be sent.

    /**
     * ErrorHandler class construction. Registers self as error handler for the entire session and checks config.
     * @param boolean $debug          Whether debug mode is on or off. (Default false)
     * @param boolean $mute           Whether to mute all errors. (Default false)
     * @param string  $technicalEmail Email Address of where to send errors. (Default null)
     */
    public function __construct($debug=false, $mute=false, $technicalEmail=null)
    {
        if($debug == true)
            $this->debug = true;
        if($mute == true)
            $this->mute = true;
        if(strpos($technicalEmail, '@'))
            $this->technicalEmail = $technicalEmail;

        set_error_handler(array($this, 'handleError'));
    }

    /**
     * Base error handling abilites. Must not be invoked directly.
     * @param  int    $errno   Error number. (can be a PHP Error level constant)
     * @param  string $errstr  Error description.
     * @param  string $errfile File in which the error occurs.
     * @param  int    $errline Line number where the error is situated.
     */
    private function handleError($errno, $errstr, $errfile=false, $errline=false)
    {
        $errorString = " [$errno] ".$errstr;
        if($errfile)
            $errorString = $errorString . " [F:".$errfile."]";
        if($errline)
            $errorString = $errorString . " [L:".$errline."]";
        $errorString = $errorString . "</pre><br />";

        switch($errno)
        {
            case E_USER_ERROR:
            case E_ERROR:
                if(!$this->mute)
                {
                    if($this->debug)
                        echo "<pre>FATAL</b>".$errorString;
                    else
                        echo $this->friendlyMsg;
                    exit;
                }
                break;
            case E_USER_WARNING:
            case E_WARNING:
                if(!$this->mute)
                {
                    if($this->debug)
                        echo "<pre>WARNING</b>".$errorString;
                    else
                        echo $this->friendlyMsg;
                }
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                if(!$this->mute)
                {
                    if($this->debug)
                        echo "<pre>NOTICE</b>".$errorString;
                }
                break;

            /*
                Add your own error cases here!
            */

            default:
                // Do nothing for any other errors.
                break;
        }

        if(in_array($errno, $this->sendEmail))
            $this->sendTechnicalEmail($errno, $errstr, $errfile, $errline);
    }

    /**
     * Trigger a custom error through this error handler.
     * @param  string $msg  Your custom error message
     * @param  string $type Type of error (FATAL, ERROR, WARNING or NOTICE) (Anything else is treated as WARNING) (Default null)
     */
    public function triggerError($msg, string $type=null)
    {
        $type = strtoupper($type);
        switch ($type) {
            case 'FATAL':
            case 'ERROR':
                $type = E_USER_ERROR;
                break;
            case 'WARNING':
            default:
                $type = E_USER_WARNING;
                break;
            case 'NOTICE':
                $type = E_USER_NOTICE;
                break;
        }

        $this->handleError($type, $msg);
    }

    public function sendTechnicalEmail($errno, $errstr, $errfile=false, $errline=false)
    {
        if(strpos($this->technicalEmail, '@'))
        {
            $message = "Your website has generated an unexpected error:
No: $errno";
            if($errfile)
                $message = $message . "
File: $errfile";
            if($errline)
                $message = $message . "
Line: $errline";

            $message = $message . "
Error: $errstr";

            // Add an @ to stop inception.
            $send = @mail($this->technicalEmail, "Error on your website", $message, "From: NoReply@ErrorHandler");
        }
    }
}

?>