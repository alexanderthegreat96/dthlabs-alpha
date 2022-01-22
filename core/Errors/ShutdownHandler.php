<?php
    /**
     * Shutdown handler function
     * for custom error mapping
     */
    function shutdownHandler()
    {
        $lasterror = error_get_last();
        if (in_array($lasterror['type'], array(E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR, E_CORE_WARNING, E_COMPILE_WARNING, E_PARSE))) {
            echo "<div style='width: 70%;margin:auto;'><h1>Kernel Error</h1></div>";
            \LexSystems\Framework\Core\Errors\ErrorHandler::errorHandler($lasterror['type'], $lasterror['message'], $lasterror['file'], $lasterror['line']);
            echo "<div style='width: 70%;margin: auto;'><h6>Built by LexSystems & powered by DTH Labs Alpha</h6></p></div>";
        }
    }

