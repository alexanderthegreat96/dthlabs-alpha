<?php
require __DIR__ . "/../core/App.php";
\LexSystems\Framework\Core\App::boot();
$doctrineModelFactory = new \LexSystems\Core\System\Factories\DoctrineModelFactory();
$doctrineModelFactory->build();