<?php
require __DIR__ . "/../core/AppCli.php";
\LexSystems\Framework\Core\AppCli::boot();
print("Started migrations for specified table structures \n");
\LexSystems\Framework\Database\Migrations::upDb();