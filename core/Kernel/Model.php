<?php
namespace LexSystems\Framework\Kernel;
abstract class Model
{
    /**
     * @return System
     */

    public function system()
    {
        return new System();
    }
}
