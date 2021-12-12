<?php
    function shutdownHandler()
    {
        $lasterror = error_get_last();
        if (in_array($lasterror['type'], array(E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR, E_CORE_WARNING, E_COMPILE_WARNING, E_PARSE))) {
            \LexSystems\Framework\Kernel\ErrorHandler::errorHandler($lasterror['type'], $lasterror['message'], $lasterror['file'], $lasterror['line']);
        }
    }

