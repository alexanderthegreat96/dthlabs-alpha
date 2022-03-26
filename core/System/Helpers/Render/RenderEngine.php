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
        $defaultPathViews = "../resources/views";
        $defaultPathCache = "../resources/cache";
        $templatePath = $templatePath ? $templatePath : $defaultPathViews;
        $compiledPath = $compiledPath ? $compiledPath : $defaultPathCache;

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
