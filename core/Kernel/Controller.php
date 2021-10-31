<?php
/**
 * Route handler
 * Controller
 */

namespace LexSystems\Framework\Kernel;

abstract class Controller extends \Buki\Router\Http\Controller
{
    /**
     * @return System
     */
    public function system()
    {
        return new System();
    }
}
