<?php
namespace LexSystems\Framework\Kernel;
use Illuminate\Database\Eloquent;
abstract class Model extends Eloquent\Model
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

    public function __construct(array $attributes = [])
    {
        $system = new System();
        $this->system = $system;
        $this->utils  = $system->utils();
        $this->queryBuilder = $system->queryBuilder();
        $this->mysqli = $system->mysqli();

        /**
         * Call the Eloquent Model Constructor
         * with the assigned attributes:
         * fillable,guarded etc
         */
        parent::__construct($attributes);
    }
}
