<?php
namespace LexSystems\Core\System\Helpers\Render;
use eftec\bladeone\BladeOne;

class RenderEngine extends BladeOne
{
    /**
     * @param string $templatePath
     * @param string $compiledPath
     * @param int $mode
     */
    public function __construct(string $templatePath = '', string $compiledPath = '', int $mode = 5)
    {
        $templatePath = $templatePath ? $templatePath : realpath($_SERVER["DOCUMENT_ROOT"]).'/resources/views';
        $compiledPath = $compiledPath ? $compiledPath : realpath($_SERVER["DOCUMENT_ROOT"]).'/resources/cache';

        parent::__construct($templatePath, $compiledPath, $mode);
    }

    /**
     * @return mixed
     */
    public function renderPage()
    {
        return BladeOne($this->templatePath,$this->compiledPath,$this->mode);
    }
}
