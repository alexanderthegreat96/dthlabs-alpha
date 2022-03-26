<?php
require __DIR__ . "/../core/AppCli.php";
\LexSystems\Framework\Core\AppCli::boot();
print("Started migrations update for specified tables \n");
\LexSystems\Framework\Database\Migrations::update();