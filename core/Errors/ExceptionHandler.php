<?php
namespace LexSystems\Framework\Core\Errors;
use LexSystems\Core\System\Helpers\Requests;
use LexSystems\Core\System\Helpers\Debugger;
use LexSystems\Framework\Config\Kernel\Error;
use LexSystems\Framework\Core\Kernel\View;
class ExceptionHandler
{
    /**
     * Exception handler.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        $requests = new Requests();
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (Error::ERROR_REPORTING) {
            echo "<title>KERNEL ERROR</title>";
            echo "<style>body{background-color: #0073e6; color: #fff; font-family : arial; font-size: 15px;}.error-div{padding: 2%;background-color: #2b2c2e;color: #fff;border: 1px solid red;}.error-p{background-color: #3a3b3d;color: #cccc12;border: 1px solid #5d12cc;padding: 1%;}pre {	width: 100%;	padding: 0;	margin: 0;	overflow: auto;	overflow-y: hidden;	font-size: 12px;	line-height: 20px;	background-color:#1e211f;}</style>";
            echo '<div style="width: 70%;margin:auto;padding: 0.5%;">';
            echo "<h1>Kernel Crash</h1>";
            echo "<h2>Exception</h2>";
            echo "<div class='error-div>'>";
            echo "<p class='error-p'><b>Uncaught exception</b>: '" . get_class($exception) . "'</p>";
            echo "<p class='error-p'><b>Message</b>: '" . $exception->getMessage() . "'</p>";
            echo "<p class='error-p'><b>Stack trace</b>:";
            echo '<pre>'.$exception->getTraceAsString().'</pre>';
            echo '</p>';
            echo "<p class='error-p'><b>Thrown in </b>: '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
            echo "<p class='error-p'><b>Request Mapping</b>:";
            Debugger::var_dump($requests->getArguments());
            echo "</p>";
            echo "</div>";
            echo "<p><h6>Built by LexSystems & powered by DTH Labs Alpha</h6></p>";
            echo '</div>';
        } else {
            $log = dirname(__DIR__) . '/../logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
            error_log($message);
            View::renderTemplate($code.'.html');
        }
    }
}
