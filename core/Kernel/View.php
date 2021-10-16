<?php
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\View\RenderEngine;

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

        $file = dirname(__DIR__) . "/resources/views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
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
    public function renderTemplate($template, $args = [])
    {
        $bladeOne = $this->renderEngine();
        echo $bladeOne->setView($template)
        ->share($args)
        ->run();
    }
}
