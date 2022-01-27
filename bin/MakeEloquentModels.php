<?php
require __DIR__ . "/../core/App.php";
\LexSystems\Framework\Core\App::boot();
$illuminateModelFactory = new \LexSystems\Core\System\Factories\IlluminateModelFactory();
$illuminateModelFactory->build();