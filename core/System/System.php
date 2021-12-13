<?php
namespace LexSystems\Framework\Kernel;
use duzun\hQuery;
use jabarihunt\Password;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Query;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\RandomStringGenerator;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\SqlFormatter;
use LexSystems\Framework\Kernel\Helpers\CoreUtils\Utils;
use LexSystems\Framework\Kernel\Helpers\Database\MySqli;
use LexSystems\Framework\Kernel\Helpers\Debugger\Debugger;
use LexSystems\Framework\Kernel\Helpers\Render\RenderEngine;
use LexSystems\Framework\Kernel\Helpers\Requests;
use LexSystems\Framework\Kernel\Helpers\Sesssions\Session;
use LexSystems\Framework\Kernel\Helpers\Utils\ArrayForm;
use LexSystems\Framework\Kernel\Helpers\Utils\LoremIpsum;

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

    public function request()
    {
        return new Requests();
    }

    /**
     * @return Session
     */

    public function session()
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

    /**
     * @param string $password
     * @return string
     * @throws \Exception
     */

    public function hashPassword(string $password = '')
    {
        try
        {
            return Password::create($password,'',10);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool|string
     */

    public function isValidPassword(string $password = '', string $hash = '')
    {
        try
        {
           return Password::compare($password, $hash);  // returns boolean
        }
        catch (\Exception $e)
        {
           return $e->getMessage();
        }
    }

    /**
     * @param string $sql
     * @return String
     */

    public function formatSql(string $sql  = '')
    {
        return SqlFormatter::format($sql,true);
    }

    /**
     * @return LoremIpsum
     */

    public function loremIpsum()
    {
        return new LoremIpsum();
    }

    /**
     * @param string $password
     * @param string $hashKey
     * @return false|string
     */

    public function hashThisPassword(string $password, string $hashKey = '')
    {
        if(!$hashKey)
        {
            $hashKey = 'RR5145LEXSYSTEMS';
        }
        return hash('sha512', $password . $hashKey);
    }

    /**
     * @param array $formData
     * @param array $formElements
     * @return ArrayForm
     */
    public function arrayForm(array $formElements = [], array $formData = [])
    {
        return new ArrayForm($formElements,$formData);
    }


}
