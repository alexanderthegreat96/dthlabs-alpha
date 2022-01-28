<?php
namespace LexSystems\Core\System\Helpers\Database;
use Illuminate\Container\Container;

class IlluminateDb extends \Illuminate\Database\Capsule\Manager
{
    public function __construct(Container $container = null)
    {
        parent::__construct($container);
    }
}