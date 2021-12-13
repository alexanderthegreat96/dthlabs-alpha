<?php
namespace LexSystems\Framework\Kernel;
abstract class Model
{
    /**
     * @var System
     */
    protected $system;
    /**
     * @var Helpers\CoreUtils\Utils
     */
    protected $utils;
    /**
     * @var \Doctrine\DBAL\Query\QueryBuilder|string
     */
    protected $queryBuilder;
    /**
     * @var Helpers\Database\MySqli
     */
    protected $mysqli;

    public function __construct()
    {
        $system = new System();
        $this->system = $system;
        $this->utils  = $system->utils();
        $this->queryBuilder = $system->queryBuilder();
        $this->mysqli = $system->mysqli();
    }
}
