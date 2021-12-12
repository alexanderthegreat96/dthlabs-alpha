<?php
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\System;
/**
 * Error and exception handler
 *
 * PHP version 7.0
 */
class Error
{

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     *
     * @return void
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting, so let it fall
            // through to the standard PHP error handler
            return false;
        }

        // $errstr may need to be escaped:
        $errstr = htmlspecialchars($errstr);


        echo "<title>KERNEL ERROR</title>";
        echo "<style>body{background-color: #0073e6; color: #fff; font-family : arial; font-size: 15px;}.error-div{padding: 2%;background-color: #2b2c2e;color: #fff;border: 1px solid red;}.error-p{background-color: #3a3b3d;color: #cccc12;border: 1px solid #5d12cc;padding: 1%;}</style>";
        echo '<h1>Kernel Crash</h1>';
        echo '<div class="error-div">';
        switch ($errno) {
            case E_USER_ERROR:
                echo "<b>System caught an error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;

            case E_USER_WARNING:
                echo "<b>System caught a warning error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_USER_NOTICE:
                echo "<b>System caught a notice </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;

            case E_ERROR:
                echo "<b>Runtime Error</b> [$errno] $errstr<br />\n";
                echo "  Fatal error on line $errline in file $errfile";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                echo "Aborting...<br />\n";
                break;
            case E_CORE_ERROR:
                echo "<b>Core Error</b> [$errno] $errstr<br />\n";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                break;
            case E_COMPILE_ERROR:
                echo "<b>Script compile error</b> [$errno] $errstr<br />\n";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                break;
            case E_PARSE:

                echo "<p><b>System caught a parse error </b> <p class='error-p'>[$errno] $errstr in [$errfile]</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> Operating system: (" . PHP_OS . ")</p>\n";
                break;
            case E_RECOVERABLE_ERROR:
                echo "<b>System caught a recoverable error </b> <p class='error-p'>[$errno] in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_WARNING:
                echo "<b>System caught a warning error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_CORE_WARNING:
                echo "<b>System caught a warning error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_COMPILE_WARNING:
                echo "<b>System caught a compiling error </b> <p class='error-p'>[$errno] in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_NOTICE:
                echo "<b>System caught a notice </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_STRICT:
                echo "<b>System caught a strict error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            default:
                echo "<b>System caught an unknown error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
        }
        echo '</div>';
        echo "<p><h6>Built by LexSystems & powered by DTH Labs Alpha</h6></p>";

        /* Don't execute PHP internal error handler */
        return true;
    }


    /**
     * Exception handler.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (\LexSystems\Framework\Configs\Kernel\Error::ERROR_REPORTING) {
            echo "<title>KERNEL ERROR</title>";
            echo "<style>body{background-color: #0073e6; color: #fff; font-family : arial; font-size: 15px;}.error-div{padding: 2%;background-color: #2b2c2e;color: #fff;border: 1px solid red;}.error-p{background-color: #3a3b3d;color: #cccc12;border: 1px solid #5d12cc;padding: 1%;}</style>";
            echo "<h1>Kernel Crash</h1>";
            echo "<h2>Fatal error</h2>";
            echo "<div class='error-div>'>";
            echo "<p class='error-p'><b>Uncaught exception</b>: '" . get_class($exception) . "'</p>";
            echo "<p class='error-p'><b>Message</b>: '" . $exception->getMessage() . "'</p>";
            echo "<p class='error-p'><b>Stack trace</b>:<pre class='error-p'>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p class='error-p'><b>Thrown in </b>: '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
            echo "</div>";
            echo "<p><h6>Built by LexSystems & powered by DTH Labs Alpha</h6></p>";
        } else {
            $log = dirname(__DIR__) . '/../logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            $system = new System();
            $system->view()->renderTemplate($code);
        }
    }
}
