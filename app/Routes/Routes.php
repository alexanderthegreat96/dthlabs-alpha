<?php
namespace LexSystems\Framework;

class Routes
{
    /**
     * @return array
     * Array of routes
     * used for the app
     */
    public static function returnRoutes()
    {
        return
            [

                /**
                 * Begin array
                 */

               [
                   'route' => '/*',
                   'controller' => 'MyController',
                   'action' => 'myActionName'
               ],


                /**
                 * End Array
                 */

            ];
    }
}
