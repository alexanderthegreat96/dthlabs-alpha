<?php

namespace LexSystems\Core\System\Helpers\Database;

use Illuminate\Container\Container;
use LexSystems\Core\System\Helpers\Arrays\ArrayUtility;
use LexSystems\Core\System\Helpers\CoreUtils\SqlFormatter;
use LexSystems\Core\System\Helpers\Debugger;

class IlluminateDb extends \Illuminate\Database\Capsule\Manager
{
    /**
     * @param Container|null $container
     */
    public function __construct(Container $container = null)
    {
        parent::__construct($container);
    }

    /**
     * Return SQLFormatter::format
     */
    public static function getQuery()
    {
        $queries = IlluminateDb::connection()->getQueryLog();
        $formattedQueries = [];
        foreach ($queries as $query) :
            $prep = $query['query'];

            foreach ($query['bindings'] as $binding) :

                if (is_bool($binding)) {
                    $val = $binding === true ? 'TRUE' : 'FALSE';
                } else if (is_numeric($binding)) {
                    $val = $binding;
                } else {
                    $val = "'$binding'";
                }

                $prep = preg_replace("#\?#", $val, $prep, 1);
            endforeach;
            $formattedQueries[] = $prep;
        endforeach;

        if ($formattedQueries) {
            echo '<ul>';
            foreach ($formattedQueries as $query) {
                echo '<li>' . SqlFormatter::format($query) . '</li>';
            }
            echo '</ul>';
        }
    }
}