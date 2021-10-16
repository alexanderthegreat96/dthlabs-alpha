<?php
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Query;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\RandomStringGenerator;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Utils;
use LexSystems\Framework\Kernel\Helpers\Database\MySqli;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use LexSystems\Framework\Kernel\Helpers\Render\RenderEngine;
use LexSystems\Framework\Kernel\Helpers\Requests;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;

class System
{
    /**
     * @return Utils
     */
    public function utils()
    {
        return new Utils();
    }

    /**
     * @param array $array
     * @return string
     * Dump and die
     */
    public function dd(array $array)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        http_response_code(500);
        Debugger::var_dump($array);
        die(1);
    }

    /**
     * @param array $array
     * @return string
     * Debugger Var Dump
     */

    public function var_dump(array $array)
    {
        return Debugger::var_dump($array);
    }

    /**
     * @return Requests
     */

    public function requests()
    {
        return new Requests();
    }

    /**
     * @return Session
     */

    public function sessions()
    {
        return new Session();
    }

    /**
     * @return RenderEngine
     */

    public function renderEngine()
    {
        return new RenderEngine();
    }


    /**
     * @return View
     */
    public function view()
    {
        return new View();
    }

    /**
     * @return RandomStringGenerator
     */

    public function StringGenerator()
    {
        return new RandomStringGenerator();
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder|string
     */

    public function queryBuilder()
    {
        $builder = new Query();
        return $builder->queryBuilder();
    }

    /**
     * @return MySqli
     */

    public function mysqli()
    {
        return new MySqli();
    }

}