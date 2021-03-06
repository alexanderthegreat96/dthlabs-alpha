<?php
namespace LexSystems\Framework\Core\Errors;
/**
 * Error and exception handler
 *
 * PHP version 7.0
 */
class ErrorHandler
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
        echo '<div style="width: 70%;margin:auto;padding: 0.5%;">';
        echo '<div class="error-div">';
        switch ($errno) {
            case E_USER_ERROR:
                echo "<b>Error: </b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;

            case E_USER_WARNING:
                echo "<b>Warning error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line:  <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_USER_NOTICE:
                echo "<b>Notice:</b> <p class='error-p'>[$errno] $errstr in <b>$errline</b> at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;

            case E_ERROR:
                echo "<b>Runtime Error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
                break;
            case E_CORE_ERROR:
                echo "<b>Core Error</b> [$errno] $errstr<br />\n";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                break;
            case E_COMPILE_ERROR:
                echo "<b>Compile error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line:  <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_PARSE:

                echo "<p><b>Parsing error:</b> <p class='error-p'>[$errno] $errstr in [$errfile] on line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> Operating system: (" . PHP_OS . ")</p>\n";
                break;
            case E_RECOVERABLE_ERROR:
                echo "<b>Recoverable error: </b> <p class='error-p'>$errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_WARNING:
                echo "<b>Warning:</b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_CORE_WARNING:
                echo "<b>Warning error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_COMPILE_WARNING:
                echo "<b>Compile error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_NOTICE:
                echo "<b>Notice:</b> <p class='error-p'>[$errno] $errstr in <b>$errfile</b> at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            case E_STRICT:
                echo "<b>Strict Error:</b> <p class='error-p'>[$errno] $errstr in $errfile at line: <b>$errline</b></p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
            default:
                echo "<b>System caught an unknown error </b> <p class='error-p'>[$errno] $errstr in $errfile</p>\n";
                echo "<p>PHP " . PHP_VERSION . "  <br/> (" . PHP_OS . ")</p>\n";
                break;
        }
        echo '</div>';
        echo "</div>";
        /* Don't execute PHP internal error handler */
        return true;
    }
}
