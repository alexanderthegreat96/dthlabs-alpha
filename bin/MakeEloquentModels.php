<?php
require __DIR__ . "/../core/AppCli.php";
\LexSystems\Framework\Core\AppCli::boot();
$illuminateModelFactory = new \LexSystems\Core\System\Factories\IlluminateModelFactory();
$illuminateModelFactory->build();