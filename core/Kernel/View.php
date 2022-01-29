<?php
namespace LexSystems\Framework\Core\Kernel;
use LexSystems\Core\System\Helpers\Render\RenderEngine;
use LexSystems\Framework\Core\System\System;
/**
 * View
 *
 * PHP version 7.0
 */
class View extends System
{
    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/../resources/views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found, $file has to exist in resources/view");
        }
    }

    /**
     * Render a view template BladeOne
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        $bladeOne = new RenderEngine();
        echo $bladeOne->setView($template)
        ->share($args)
        ->run();
    }
}
