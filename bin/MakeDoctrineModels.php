<?php
require __DIR__ . "/../core/AppCli.php";
\LexSystems\Framework\Core\AppCli::boot();
$doctrineModelFactory = new \LexSystems\Core\System\Factories\DoctrineModelFactory();
$doctrineModelFactory->build();