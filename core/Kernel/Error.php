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
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
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
            echo "<style>";
            echo "body{background-color: #0073e6; color: #fff; font-family : arial; font-size: 15px;}";
            echo "</style>";
            echo "<h1>Kernel Crash</h1>";
            echo "<h2>Fatal error</h2>";
            echo "<p><b>Uncaught exception</b>: '" . get_class($exception) . "'</p>";
            echo "<p><b>Message</b>: '" . $exception->getMessage() . "'</p>";
            echo "<p><b>Stack trace</b>:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p><b>Thrown in </b>: '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
            echo "<p><h6>LexSystems</h6></p>";
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
