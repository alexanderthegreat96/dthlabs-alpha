<?php
/**
 * Route handler
 * Controller
 */
namespace LexSystems\Framework\Kernel;
use LexSystems\Framework\Kernel\Helpers\Requests;

class Controller extends System
{
    protected $requests = Requests::class;
}
